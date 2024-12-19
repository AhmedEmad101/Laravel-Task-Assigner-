<?php

use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\SmsController;
use App\Http\Controllers\TaskController;
use App\Http\Controllers\TeamController;
use App\Http\Controllers\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Middleware\Admin;
Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');
////////////Authentication ///////////////////////////////////
//////////////////////////////////////////////////////////////
route::post('login',[AuthController::class,'Login'])->name('loginapi');
route::post('logout',[AuthController::class,'logout']);
route::get('user/{id}',action: [UserController::class,'UserInfo']);
route::get('test/{id}',action: [UserController::class,'test'])->middleware('auth:sanctum','admin');//user and admin check
route::get('test',action: [UserController::class,'test'])->middleware('auth:sanctum' , Admin::class);
route::get('tier',action: [UserController::class,'subscripe'])->middleware('auth:sanctum');
route::get('usertasks/{id}',action: [UserController::class,'task']);
route::get('testtaskpolicy/{task}',action: [UserController::class,'taskpolicy'])->middleware('auth:sanctum');
////////////////////////////////////////////////////////
Route::get('alltasks', [TaskController::class, 'index']);
Route::get('allusers', [UserController::class, 'index']);
Route::get('allprojects', [ProjectController::class, 'index']);
////////////////////////////////////////////////////////////////
Route::post('send', [SmsController::class, 'send']);
Route::post('createteam', [TeamController::class, 'store']);
