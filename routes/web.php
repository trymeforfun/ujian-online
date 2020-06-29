<?php

use App\Model\User;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
// Admin
Route::get('/admin_login', 'Admin\AdminLoginController@showLoginForm');
Route::post('/login', 'Admin\AdminLoginController@login');
Route::get('/admin', 'Admin\AdminController@index');
// admin 

//  Landing page
Route::get('/', function () { return 'login'; });
//  End

// user
Route::get('_login', 'User\LoginController@showLoginForm');
Route::post('_loginPost', 'User\LoginController@login');
Route::get('user', 'User\UserController@index');
Route::get('user/json', 'User\UserController@json')->name('user/json');
Route::get('teacher', 'User\TeacherController@index');
Route::get('users', 'User\UserController@userShow');
Route::post('user/store', 'User\UserController@store')->name('user/store');
Route::get('user/edit/{id}', 'User\UserController@edit')->name('user/edit/{id}');
Route::delete('user/delete/{id}', 'User\UserController@destroy')->name('user/delete/{id}');
// user

Route::resource('student', 'StudentController');
Route::resource('lesson', 'LessonController');
Route::resource('kelas', 'KelasController');
Route::resource('question', 'QuestionController');
Route::get('question/list/{assignId}', 'Questioncontroller@list');
Route::get('question/detail/{assignId}', 'QuestionController@detail');
// assginment
Route::get('/assignment', 'AssignmentController@index');
Route::post('/changestatus', 'AssignmentController@changeStatus')->name('changestatus');
Route::get('/assignment/create', 'AssignmentController@create');
Route::post('/assignment/store', 'AssignmentController@store');


Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
