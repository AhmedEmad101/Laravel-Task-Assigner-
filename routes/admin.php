<?php
use Illuminate\Support\Facades\Route;
use App\Http\Middleware\Admin;
Route::get('/', function () {
    return view('welcome');
});

Route::view('admin','admin')->middleware('auth:sanctum','admin');
Route::get('AdminContacts', [ContactUsController::class,'show']);
route::get('GotoAdminPage',[AuthController::class,'GotoAdminPage']);
Route::view('adminallusers','PartialViews.admin.allusers');

