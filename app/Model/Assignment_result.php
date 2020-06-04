<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Assignment_result extends Model
{
    protected $table = 'assignment_result';

    public function assignment()
    {
        return $this->belongsTo('App\Model\Assignment');
    }   
}
