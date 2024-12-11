<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\SmsController;
use App\Http\Middleware\Admin;
Route::view('admin','admin');
/////////////////////////////////////////////////////
Route::get('/', function () {
    return view('welcome');
});
$pages = ['home','task', 'project','team','login','subscriptions','admin'];
foreach ($pages as $page) {
    Route::view($page, $page);
}
//createproject
Route::post('createproject', [ProjectController::class, 'store']);
Route::get('allprojects', [ProjectController::class, 'index']);
Route::view('AllProjects','AllProjects');
Route::view('test','Test.login');
/////////////////////////////////////////
Route::get('send', [SmsController::class, 'send']);
///////////////////////////////////////////////////////////////
