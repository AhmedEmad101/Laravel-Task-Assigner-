<?php

use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\PaypalController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\SmsController;
use App\Http\Controllers\TaskController;
use App\Http\Controllers\TeamController;
use App\Http\Controllers\TierController;
use App\Http\Controllers\UserController;
use App\Http\Middleware\Admin;
Route::view('admin','admin');
/////////////////////////////////////////////////////
Route::get('/', function () {
    return view('welcome');
});
route::post('login2',[AuthController::class,'login2'])->name('loginapi');//test login 2
route::post('logout',[AuthController::class,'logout']);
Route::get('tier', [TierController::class, 'index']);
$pages = ['home','task', 'project','team','login','subscriptions','admin','mytasks','myteams'];
foreach ($pages as $page) {
    Route::view($page, $page);//->middleware('throttle:3,60');
}
//createproject
Route::post('createproject', [ProjectController::class, 'store']);
Route::get('allprojects', [ProjectController::class, 'index'])->name('allprojects.index');
Route::view('AllProjects','AllProjects');
Route::delete('delete/{project}', [ProjectController::class, 'destroy']);
///////////////////////////////////////////////////////////////////////////////
Route::get('mytasks', [TaskController::class, 'index']);
//////////////////////////////////////////////////////
Route::get('allteams', [TeamController::class,'index']);
//////////////////////////////////////////////////////////
Route::view('adminallusers','PartialViews.admin.allusers');
Route::view('test','Test.login');
/////////////////////////////////////////
Route::get('send', [SmsController::class, 'send']);
route::post('Pay/{id}',[PaypalController::class,'Payment']);
route::get('PaymentSuccess/{tier}',[PaypalController::class,'PaymentSuccess'])->name('PS');
route::get('PaymentCancel',[PaypalController::class,'PaymentCancel'])->name('PC');
///////////////////////////////////////////////////////////////
