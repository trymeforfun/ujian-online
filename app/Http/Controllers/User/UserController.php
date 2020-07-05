<?php

namespace App\Http\Controllers\User;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Arr;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Hash;
use App\Model\Student;
use App\Model\User;
use App\Model\Assignment;
use App\Model\Teacher;
use Illuminate\Http\Response;
use App\Model\Kelas;
use Illuminate\Support\Facades\Redis;
use Yajra\DataTables\DataTables;

class UserController extends Controller
{

   

    public function index(Request $request)
    {
        // Catch DB
        // $result = Assignment::GetResultByAssignment();
        $students = Student::all();
        // $assignment_active = Assignment::select('assignment_active')->get();
        $all_assignment = Assignment::all();
        # End
        $total_students = $students;
        if ($request->session()->get('level') == 'staff') {
            $total_students = count($students);
            //    $total_result = [];
        } else {
            $total_students = count($students);

        }


           return view('users.dashboard', compact( 'total_students'));

    }

    public function json(Request $request)
    {
        $list_user = User::all();
        if ($request->ajax()) {
            return datatables()->of($list_user)
                        ->addColumn('action', function($data){
                            $button = '<a href="javascript:void(0)" data-toggle="tooltip" id="edit-user"  data-id="'.$data->id.'" data-original-title="Edit" class="edit btn btn-info btn-sm"><i class="far fa-edit"></i> Edit</a>';
                            $button .= '&nbsp;&nbsp;';
                            $button .= '<button type="button" name="delete" id="delete-user" data-id="'.$data->id.'" class="delete btn btn-danger btn-sm"><i class="far fa-trash-alt"></i> Delete</button>';     
                            return $button;
                        })
                        ->rawColumns(['action'])
                        ->addIndexColumn()
                        ->make(true);
       
        }
    }
    
    
    
    public function userShow()
    {
        return view('users.user');
    }
    
    public function store(Request $request)
    {
       $user =  User::updateOrCreate(['id' => $request->id],
        [
            'username' => $request->username,
            'password' => Hash::make($request->password) ,
            'level' => $request->level,
            'email' => $request->email,
            'is_active' => $request->is_active,
        ]);  
        return response()->json($user);
    }

    public function edit($id)
    {
        $user  = User::where(['id' => $id])->first();
        return response()->json($user);
    }
    
    public function destroy($id)
    {
        $post = User::where('id',$id);
        $post->delete();
        return response()->json($post);
    }

    
}


