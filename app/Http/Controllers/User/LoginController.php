<?php

namespace App\Http\Controllers\User;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\Controller;
use App\Model\User;
use App\Model\Teacher;
use Illuminate\Support\Facades\Session;
class LoginController extends Controller
{
    public function showLoginForm()
    {
       return view('users.user_login');
    }

    public function login(Request $request)
    {
        
            $validator = Validator::make($request->all(), [
                'username' => 'required',
                'password' => 'required',
        ]);
    
        if ($validator->fails()) {
            return redirect('/_login')
                        ->withErrors($validator);
        } else {
    
            $username = $request->input('username');
            $pass = $request->input('password');
        
            $user = User::where('username', $username)->first();
            $teacher = Teacher::where('teacher_username', $username)->first();
            
            if ($user != null || $teacher != null) {
              if ($user['is_active'] > 0 || $teacher['teacher_hide'] == 0) {
                if (password_verify($pass, $user['password'])) {
                   if ($user['level'] == 'staff'){
                       $data = [
                           'id_' => $user['id'],
                           'username' => $user['username'],
                           'level' => $user['level']
                      ];
                      Session::put($data);
                      return redirect('/user');
                    } 
                } elseif (password_verify($pass, $teacher['teacher_password'])) {
                    $data = [
                        'id' => $teacher['id'],
                        'id_' => $teacher['id'],
                        'fullname' => $teacher['teacher_name'],
                        'username' => $teacher['teacher_username'],
                        'level' => 'guru',
                    ];
                    Session::put($data);
                   return redirect('/user');
               } else {
                    $request->session()->flash('status', 'Wrong password !!');
                    return redirect('/_login');
                }
              } else {
                  $request->session()->flash('status', 'Your username is not active !!');
                  return redirect('/_login');
              }
            } else {
            $request->session()->flash('status', 'You have not register yet!!');
            return redirect('/_login');
        }
    
        
    
    }
    }
}
