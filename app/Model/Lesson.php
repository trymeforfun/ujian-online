<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Lesson extends Model
{
    protected $table = 'lesson';
    protected $fillable = ['lesson_name'];

    public function assignment()
    {
        return $this->hasMany(Assignment::class);
    }

    public function question()
    {
        return $this->hasMany(Question::class);
    }

    public function teacher()
    {
        return $this->belongsToMany(Teacher::class);
    }
}
