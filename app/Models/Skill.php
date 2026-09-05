<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Skill extends Model
{
   protected $primaryKey='id_skill';
   protected $fillable =[
    'user_id',
    'titre',
    'description',
    'image',
    'niveau',
     
   ];
   public function user()
   {
    return $this->belongsTo(User::Class);
   }
}
