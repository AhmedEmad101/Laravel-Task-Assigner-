<?php

use App\Http\Controllers\ProjectController;
use App\Http\Controllers\TaskController;
use App\Http\Controllers\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');
Route::get('alltasks', [TaskController::class, 'index']);
Route::get('allusers', [UserController::class, 'index']);
Route::get('allprojects', [ProjectController::class, 'index']);
