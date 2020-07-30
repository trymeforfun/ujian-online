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


Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
