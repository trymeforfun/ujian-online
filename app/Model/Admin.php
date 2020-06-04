<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Admin extends Model
{
    protected $guard = 'admin';
    protected $table ='admin';


    protected $fillable = ['username', 'fullname', 'password'];
    protected $hidden = [
        'password', 'remember_token'
   ];
}
