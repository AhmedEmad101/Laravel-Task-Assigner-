<?php

use App\Http\Controllers\PaypalController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\SmsController;
use App\Http\Controllers\TierController;
use App\Http\Controllers\UserController;
use App\Http\Middleware\Admin;
Route::view('admin','admin');
/////////////////////////////////////////////////////
Route::get('/', function () {
    return view('welcome');
});
Route::get('tier', [TierController::class, 'index']);
$pages = ['home','task', 'project','team','login','subscriptions','admin','mytasks'];
foreach ($pages as $page) {
    Route::view($page, $page);
}
//createproject
Route::post('createproject', [ProjectController::class, 'store']);
Route::get('allprojects', [ProjectController::class, 'index']);
Route::get('mytasks', [UserController::class, 'task']);
Route::view('AllProjects','AllProjects');
//////////////////////////////////////////////////////
Route::view('adminallusers','PartialViews.admin.allusers');
Route::view('test','Test.login');
/////////////////////////////////////////
Route::get('send', [SmsController::class, 'send']);
route::post('Pay/{id}',[PaypalController::class,'Payment']);
route::get('PaymentSuccess/{tier}',[PaypalController::class,'PaymentSuccess'])->name('PS');
route::get('PaymentCancel',[PaypalController::class,'PaymentCancel'])->name('PC');
///////////////////////////////////////////////////////////////
