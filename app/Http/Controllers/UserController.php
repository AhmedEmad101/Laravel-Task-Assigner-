<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
   public function index()
   {
    $User = User::where('id',1)->first();
    return $User->UserTasks->pluck('name');
   }
   public function UserInfo($id)
   {
    $User = User::where('id',$id)->first();
    return $User;
   }
}
