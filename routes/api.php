<?php

use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\SmsController;
use App\Http\Controllers\TaskController;
use App\Http\Controllers\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');
////////////Authentication ///////////////////////////////////
//////////////////////////////////////////////////////////////
route::post('login',[AuthController::class,'Login']);
route::post('logout',[AuthController::class,'logout']);
route::get('user/{id}',action: [UserController::class,'UserInfo']);
route::get('test/{id}',action: [UserController::class,'test'])->middleware('auth:sanctum');;
////////////////////////////////////////////////////////
Route::get('alltasks', [TaskController::class, 'index']);
Route::get('allusers', [UserController::class, 'index']);
Route::get('allprojects', [ProjectController::class, 'index']);
////////////////////////////////////////////////////////////////
Route::post('send', [SmsController::class, 'send']);
