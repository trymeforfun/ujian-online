<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use App\Model\Admin;
use Illuminate\Support\Facades\Session;
use Illuminate\Validation;
use phpDocumentor\Reflection\Types\Self_;

class AdminLoginController extends Controller
{
    public function index()
    {
        
    }
    
    public function showLoginForm()
    {
        return view('/admin.admin_login');
    }
    
    public function login(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'username' => 'required',
            'password' => 'required',
    ]);

    if ($validator->fails()) {
        return redirect('/admin_login')
                    ->withErrors($validator);
    } else {

        $username = $request->input('username');
        $pass = $request->input('password');
    
        $admin = Admin::where('username', $username)->first();
        
        if ($admin != null) {
          if ($admin['admin_hide'] == 0) {
            if (password_verify($pass, $admin['password'])) {
               $data = [
                    'username' => $admin['username'],
                    'level' => $admin['level']
               ];
               Session::put($data);
                return redirect('/admin');
            } else {
                $request->session()->flash('status', 'Wrong password !!');
                return redirect('/admin_login');
            }
          } else {
              $request->session()->flash('status', 'Your username is not active !!');
              return redirect('/admin_login');
          }
        } else {
        $request->session()->flash('status', 'You have not register yet!!');
        return redirect('/admin_login');
    }

    }

    }

}
