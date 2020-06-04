<?php

namespace App\Http\Controllers\User;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Support\Facades\Session;

class TeacherController extends Controller
{
   public function index()
   {
       return 'Guru';
   }


}
