<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Kelas_teacher extends Model

{
    protected $table = 'kelas_teacher';
    protected $fillable = ['teacher_id', 'kelas_id'];
}
