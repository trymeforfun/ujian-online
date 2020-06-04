<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Option extends Model
{
    protected $table = 'option';
    protected $fillable = ['option_', 'question_id', 'option_true'];

    public function question()
    {
        return $this->belongsTo(Question::class);
    }
}
