<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
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
   public function test($id)
   {
      $user = Auth::user();
    return response()->json($user);
   }
}
