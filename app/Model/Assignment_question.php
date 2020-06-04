<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Assignment_question extends Model
{
    protected $table = 'assignment_question';
    protected $fillable = ['assignment_id', 'question_id'];
    public $timestamps = false;
}   
