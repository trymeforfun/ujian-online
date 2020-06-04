<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
    protected $table = 'question';
    protected $fillable = ['question_name',];

    public function assignment()
    {
        return $this->belongsToMany(Assignment::class);
    }

    public function lesson()
    {
        return $this->belongsTo(Lesson::class);
    }

    public function option()
    {
        return $this->hasMany(Option::class);
    }
}
