<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use App\Model\Student;
use Intervention\Image\Facades\Image;
class StudentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request) {  
        $list_user = Student::all();
        if($request->ajax()){
        return datatables()->of($list_user)
                    ->addColumn('action', function($data){
                        $button = '<a href="javascript:void(0)" data-toggle="tooltip" id="edit-stdnt"  data-id="'.$data->id.'" data-original-title="Edit" class="edit btn btn-info btn-sm"><i class="far fa-edit"></i> Edit</a>';
                        $button .= '&nbsp;&nbsp;';
                        $button .= '<button type="button" name="delete" id="delete-stdnt" data-id="'.$data->id.'" class="delete btn btn-danger btn-sm"><i class="far fa-trash-alt"></i> Delete</button>';     
                        return $button;
                    })
                    ->rawColumns(['action'])
                    ->addIndexColumn()
                    ->make(true);
   
                }
        return view('users/student'); 
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
    
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // $this->validate($request, [
		// 	'student_photo' => 'required|file|image|mimes:jpeg,png,jpg|max:2048',
		// ]);
           $student = Student::updateOrCreate(['id' => $request->id],
            [
            'student_name' => $request->student_name,
            'class_id' => $request->class_id,
            'student_password' => bcrypt(Hash::make($request->password)) ,
            'student_nis' => $request->student_nis,
            'student_email' => $request->student_email,
            'student_phone' => $request->student_phone,
        ]);  
        
       return response()->json($student);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $student  = Student::where('id', $id)->first();
        return response()->json($student);
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
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $post = Student::where('id',$id);
        $post->delete();
        return response()->json($post);
    }
}
