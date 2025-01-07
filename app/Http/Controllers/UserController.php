<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Task;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
class UserController extends Controller
{

   public function index()//test function
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
   public function subscripe($id)
   {
    $User = User::where('id',$id)->first();

    return response()->json([ 'subscriptionName'=>$User->Subscription->Tier->name??404,'expires_at'=>$User->Subscription->expires_at]);
   }
   public function task()
   {
    $email = session()->get('email');
    $User = User::where('email',$email)->first();
    return view('mytasks');
   }
   public function taskpolicy(Task $task)
   {
    if (Gate::denies('update', $task)) {
        abort(403, 'Unauthorized action.');
    }

    // The user is authorized to update the post...

    return response()->json(['message' => 'Post updated successfully']);
   }
}
