<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Prunable;

class Subscription extends Model
{
    use Prunable;
   protected $fillable = ['user_Id','tier_id','expires_at'];
   protected $dates = ['expires_at'];

   public function Tier()
   {
    return $this->belongsTo(Tier::class,'tier_id')->withDefault();
   }
   public function prunable(): Builder
    {
        return static::query()->where('expires_at', '<=', now())->orderBy('expires_at', 'asc'); ;
    }

}
