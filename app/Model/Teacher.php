<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Teacher extends Model
{
    protected $table ="teacher";

    protected $fillable = ['username', 'fullname', 'password', 'email', 'id_', 'author_'];
    protected $hidden = [
        'password', 'remember_token'
   ];

   public function kelas()
   {
       return $this->belongsToMany(Kelas::class);
   }

   public function lesson()
   {
       return $this->belongsToMany(Lesson::class);
   }

   public function setPasswordAttribute($val)
   {
        return $this->attributes['password'] = bcrypt($val);
   }
    public $timestamps = false;
}
