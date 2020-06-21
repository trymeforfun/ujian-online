<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Assignment extends Model
{
    protected $table = 'assignment';

    protected $fillable = ['id_','author_','assignment_type', 'assignment_kkm', 'assignment_active', 'assignment_order','assignment_author', 'assignment_duration', 'assignmnent_path', 'assignment_hide','show_report', 'show_analytic','question_used' , 'created_at', 'updated_at', 'kelas_id'];

    public function lesson()
    {
        return $this->belongsTo(Lesson::class, 'lesson_id', 'id');
    }

    public function question()
    {
        return $this->belongsToMany(Question::class, 'assignment_question', 'assignment_id', 'question_id')->withPivot('val_hide');
    }

    


}
 