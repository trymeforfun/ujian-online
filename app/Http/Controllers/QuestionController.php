<?php

namespace App\Http\Controllers;

use App\Model\Assignment;
use App\Model\Assignment_class;
use App\Model\Question;
use App\Model\Assignment_question;
use App\Model\Lesson;
use App\Model\Option;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Http\Request;

class QuestionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request, $id)
    {
        $dataAssignment = Assignment::find($id);
        dd($dataAssignment);
        return view('users.list_question');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        // $assign = Question::find($request->id);
        // dd($assign);

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
    
        if (!$request->question_name) {
            return back()->withInput();
        } 

        $dataQuestion = new Question();
        $dataQuestion->lesson_id = $request->lesson_id;
        $dataQuestion->question_name = $request->question_name; 
        $dataQuestion->save();
        
        // FOR OPTION TABLE
        foreach (json_decode($request->input('JSONanswer')) as $row => $value) {
        	$answer = [
        		'question_id' => $dataQuestion->id,
        		'option_' => $request->input('option_'.$value->row),
        	];
        	if ($value->row == $request->input('choosedAnswer')) {
        		$answer['option_true'] = 1;
            }
            Option::insert($answer);
        }
        

        $assign_quest = new Assignment_question();
        $assign_quest->question_id = $dataQuestion->id;
        $assign_quest->assignment_id = $request->assignment_id;
        $assign_quest->save();

        return redirect('/question/list/'.$assign_quest->assignment_id);

        // return redirect('/question')->with(['assignment_id' => $assign_quest->assignment_id]);
        // if ($request->input('question_name') == '') {
		// 	$this->message('Ooppsss','Anda belum membuat soal, pastikan anda membuat soal terlebih dahulu','error');
		// 	redirect('page/create_question/'.$this->input->post('id_assignment'));
		// }
		// $dataQuestion = [
		// 	'id_lesson' => $this->input->post('id_lesson'),
		// 	'question_' => $this->input->post('question_'),
		// 	'question_created' => date('Y-m-d H:i:s')
		// ];
		// $idQuestion = $this->assignment->insertQuestion($dataQuestion);
		// // FOR OPTION //
		// // INSERT ASSIGNMENT QUESTION //
		// $assignmentQuestion = [
		// 	'id_assignment' => $this->input->post('id_assignment'),
		// 	'id_question' => $idQuestion
		// ];
		// $this->assignment->insertAssignmentQuestion($assignmentQuestion);
		// $this->message('Yeeayy!','Soal dan jawaban berhasil disimpan :)','success');
		// redirect('page/create_question/'.$this->input->post('id_assignment'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, $id)
    {
        //   $getLesson = $dataAssignment->lesson ;
        // $getQuestion = $dataAssignment->question;
        // // dd($getQuestion);
        // foreach ($getQuestion as $row => $value) {
        //     $value->totalAnswer = count($getQuestion[$row]->option);
        // }
        $dataAssignment = Assignment::find($id);
        
        return view('users.create_question', compact('dataAssignment'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    

    public function list(Request $request, $id)
    {
        $dataAssignment = Assignment::find($id);
        
        $getQuestion = $dataAssignment->question;
        foreach ($getQuestion as $row => $value) {
            $value->totalAnswer = count($getQuestion[$row]->option);
        }
        
        return view('users.list_question', compact('dataAssignment'));
    }

    public function detail($id)
    {
        $dataQuestion = Question::find($id) ;
        return view('users.detail_question', compact('dataQuestion'));
    }

}
