<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Team extends Model
{
   protected $fillable = ['name','leader_Id','member_id'];






   ////////////////////////////////////////////////
   /////////////////relationships
   public function Leader()
   {
    return $this->belongsTo(User::class,'leader_Id');
   }
}
