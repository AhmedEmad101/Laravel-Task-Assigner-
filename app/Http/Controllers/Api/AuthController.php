<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
class AuthController extends Controller
{
    public function Signup(Request $request)//not tested yet
    {
      $user = User::create($request->all());
        //  return response()->json($user);
        return redirect('index')->with('success','Account created successfully');
    }
    public function Login(Request $request)
    {
      $user = User::where('email',$request->email)->first();
      session()->put('userid',$user->id);
      if(!$user||!Hash::check($request->password,$user->password))
      {
          return response()->json(['error'=>'Your login credentials are wrong'],422);
      }
      $device = substr($request->userAgent() ??'', 0,255);
session()->put('email',$request->email);
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

              $request->session()->flush();


          // Optionally return a response
          return redirect('login');
      }
      public function login2(Request $request)//session based auth
      {
          // Validate the login form data
          $validated = $request->validate([
              'email' => 'required|email',
              'password' => 'required',
          ]);

          // Attempt to authenticate the user
          if (Auth::attempt(['email' => $request->email, 'password' => $request->password], $request->remember)) {
              // Authentication successful, store the user ID in the session
              $userId = Auth::user()->id;
              dd( Auth::user()->id);
              session(['user_id' => $userId]);  // Store user ID in the session

              // Optionally redirect to a dashboard or home page
              return view('home'); // Adjust the route name accordingly
          }

          // Authentication failed, redirect back with an error message
          return back()->withErrors(['email' => 'Invalid credentials']);
      }
}
