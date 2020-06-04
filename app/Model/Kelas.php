<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Kelas extends Model
{
   protected $fillable = ['kelas_name'];
   public $timestamps = false;
   public function Teacher()
   {
      return $this->belongsToMany(Teacher::class);
   }

   public function Student()
   {
      return $this->hasOne('App\Model\Student');
   }
}
