<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\SmsController;
Route::get('/', function () {
    return view('welcome');
});
$pages = ['home','task', 'project','team','login'];
foreach ($pages as $page) {
    Route::view($page, $page);
}
//createproject
Route::post('createproject', [ProjectController::class, 'store']);
Route::get('allprojects', [ProjectController::class, 'index']);
Route::view('AllProjects','AllProjects');
/////////////////////////////////////////
Route::get('send', [SmsController::class, 'send']);
