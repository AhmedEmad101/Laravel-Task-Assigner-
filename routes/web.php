<?php

use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\PaypalController;
use App\Http\Controllers\WorkOnController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\SmsController;
use App\Http\Controllers\SubscriptionController;
use App\Http\Controllers\TaskController;
use App\Http\Controllers\TeamController;
use App\Http\Controllers\TierController;
use App\Http\Controllers\UserController;
use App\Http\Middleware\Admin;
Route::view('admin','admin')->middleware('auth:sanctum','admin');
route::get('GotoAdminPage',[AuthController::class,'GotoAdminPage']);
/////////////////////////////////////////////////////

route::post('login2',[AuthController::class,'login2'])->name('loginapi');//test login 2
route::post('logout',[AuthController::class,'logout']);
Route::get('tier', [TierController::class, 'index']);
$pages = ['home','task', 'project','team','login','admin','mytasks','myteams','AllProjects','member','about','contactus'];
foreach ($pages as $page) {
    Route::view($page, $page)->name($page);//->middleware('throttle:3,60');
}
Route::get('subscriptions', [SubscriptionController::class,'index']);
//createproject
Route::post('createproject', [ProjectController::class, 'store']);
Route::get('allmyprojects', [ProjectController::class, 'index'])->name('allprojects.index');
Route::delete('delete/{project}', [ProjectController::class, 'destroy']);
///////////////////////////////////////////////////////////////////////////////
Route::get('mytasks', [TaskController::class, 'index']);
Route::get('createtask', [TaskController::class, 'create']);
Route::post('storetask', [TaskController::class, 'store']);
Route::delete('deletetask/{task}', [TaskController::class, 'destroy']);
//////////////////////////////////////////////////////
Route::post('allmyteams', [TeamController::class,'index']);
Route::get('toteammember', [TeamController::class,'ToTeamMember']);
Route::get('searchuser', [TeamController::class,'SearchUser']);
Route::get('addteammember/{team}', [TeamController::class,'AddTeamMember']);
Route::get('AssignTeamMember/{task}', [WorkOnController::class,'store']);
route::get('workon',action: [WorkOnController::class,'index']);
//////////////////////////////////////////////////////////
Route::view('adminallusers','PartialViews.admin.allusers');
Route::view('test','Test.login');
/////////////////////////////////////////
Route::get('send', [SmsController::class, 'send']);
route::post('Pay/{id}',[PaypalController::class,'Payment']);
route::get('PaymentSuccess/{tier}',[PaypalController::class,'PaymentSuccess'])->name('PS');
route::get('PaymentCancel',[PaypalController::class,'PaymentCancel'])->name('PC');
///////////////////////////////////////////////////////////////
