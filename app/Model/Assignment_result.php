<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Assignment_result extends Model
{
    protected $table = 'assignment_result';

    protected $fillable = ['assignment_id', 'student_id', 'result_true', 'result_false', 'result_score', 'result_status'];
    
}
