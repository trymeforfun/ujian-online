<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Assignment_class extends Model
{
    protected $table = 'assignment_class';
    protected $fillable = ['assignment_id', 'class_id'];
    public $timestamps = false;
}
