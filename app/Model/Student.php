<?php

namespace App\Model;
use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    protected $table = 'Student';
    protected $fillable = ['student_name','class_id', 'student_nis', 'student_email', 'student_password', 'student_phone'];
    public $timestamps = false;
    public function scopeGetAllStudent()
    {
       return \App\Model\Student::all();
    }

    public function getStudentByClass($value)
    {
        return $this->hasMany('App\Model\Kelas', 'class_id');
    }
}
