<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
class AuthController extends Controller
{
    public function Signup(Request $request)
    {
      $user = User::create($request->all());
        //  return response()->json($user);
        return redirect('index')->with('success','Account created successfully');
    }
    public function Login(Request $request)
    {
      $user = User::where('email',$request->email)->first();
      if(!$user||!Hash::check($request->password,$user->password))
      {
          return response()->json(['error'=>'Your login credentials are wrong'],422);
      }
      $device = substr($request->userAgent() ??'', 0,255);
      return response()->json(
          ['access_token'=>$user->createToken($device)->plainTextToken
          ,'id'=>$user->id
          ,'name'=>$user->name
          ,'email'=>$user->email
          ,'role'=>$user->role]
      );
    }
    public function logout(Request $request)
      {
          // Revoke the current user's token
          //$request->user()->currentAccessToken()->delete();
          if ($request->user()) {
              $request->user()->currentAccessToken()->delete();
          }

          // Optionally return a response
          return response()->json([
              'message' => 'Logged out successfully'
          ], 200);
      }
}
