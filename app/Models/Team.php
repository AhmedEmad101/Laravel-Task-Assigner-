<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Team extends Model
{
   protected $fillable = ['Leader_Id','Project_Id','name'];






   ////////////////////////////////////////////////
   /////////////////relationships
   public function Leader()
   {
    return $this->belongsTo(User::class,'Leader_Id');
   }
}
