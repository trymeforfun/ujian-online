<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Model\Assignment;
use App\Model\Assignment_class;
use App\Model\Lesson;
use App\Model\Kelas;
use App\Model\Teacher;

class AssignmentController extends Controller
{
   
    public function index(Request $request )
    {
        $lesson = Lesson::all();
        $dataAssignment = Assignment::all();
        foreach($dataAssignment as $row => $value){
            $value->totalQuestion = count($dataAssignment[$row]->question);
        }
         return view('users.list_ujian', compact('dataAssignment'));
    }

    public function changeStatus(Request $request) 
    {
		if ($request->ajax()) {
			$dataAssignment = Assignment::find($request->id);
			$dataAssignment->assignment_active = $request->assignment_active;
			$dataAssignment->save();
        }
        
        return response()->json($dataAssignment);


	}

    public function create(Request $request)
    {
        
        $dataTeacher = Teacher::find($request->session()->get('id_'));
        if ($request->session()->get('level') == 'guru') {
            $getClass = $dataTeacher->kelas;
            $getLesson = $dataTeacher->lesson;
            
            return view('users.create_assignment', compact('getClass', 'getLesson'));
        } else {
            
            $getClass = Kelas::all();
            $getLesson = Lesson::all();

            return view('users.create_assignment', compact('getClass', 'getLesson'));
        }
    }

    public function store(Request $request)
    {
        

        if (!$request->input()) { 
            redirect('/assignment/create'); 
        }
        $data = $request->input();
		unset($data['show_report']);
		unset($data['show_analytic']);
        unset($data['kelas_id']);
        $show_analytic = $request->has('show_analytic') ? true : false;
        $show_report = $request->has('show_report') ? true : false;
        
        $assign = new Assignment();
            $assign->id_ = $request->session()->get('id');
            $assign->author_ = $request->session()->get('level');
            $assign->lesson_id = $request->id_lesson;
            $assign->assignment_author = $request->assignment_author;
            $assign->assignment_type = $request->assignment_type;
            $assign->assignment_kkm = $request->assignment_kkm;
            $assign->show_analytic = $show_analytic;
            $assign->show_report = $show_report;
            $assign->assignment_duration = $request->assignment_duration;
            $assign->save();
            
            foreach ($request->kelas_id as $key => $value) {
                 Assignment_class::insert([
                    'assignment_id' => $assign->id,
                    'kelas_id' => $value
                ]);
            }
            return redirect("/question".$assign->id);
    }

    
}
