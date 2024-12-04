<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});
Route::view('home','home');
Route::view('task','task');
Route::view('project','project');
Route::view('team','team');
