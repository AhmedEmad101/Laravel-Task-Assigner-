<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ContactUs extends Model
{
    protected $fillable = ['user_Id','email','message'];








    public function User()
{
    return $this->belongsTo(User::class, 'id','user_Id');
}

}
