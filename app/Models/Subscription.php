<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Subscription extends Model
{
   protected $fillable = ['user_Id','tier_id','expires_at'];


   public function Tier()
   {
    return $this->belongsTo(Tier::class,'tier_id')->withDefault();
   }
}
