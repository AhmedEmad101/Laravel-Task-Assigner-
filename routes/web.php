<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\ContactUsController;
use App\Http\Controllers\PaypalController;
use App\Http\Controllers\WorkOnController;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\SmsController;
use App\Http\Controllers\SubscriptionController;
use App\Http\Controllers\TaskController;
use App\Http\Controllers\TeamController;
use App\Http\Controllers\TierController;
use App\Http\Controllers\UserController;

// Public Welcome Page
Route::get('/', function () {
    return view('welcome');
});

// Authenticated Dashboard (give it a dedicated path)
Route::get('/dashboard', function () {
    return view('home');
})->middleware(['auth', 'verified'])->name('dashboard');

// Profile routes
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::get('Contactindex', [ContactUsController::class,'index']);
Route::get('createcontact', [ContactUsController::class,'store']);

Route::view('teamtest','test.teamtest');
Route::post('login2',[AuthController::class,'login2'])->name('loginapi');
Route::post('logout',[AuthController::class,'logout']);
Route::get('tier', [TierController::class, 'index']);

// Dynamic view pages (excluding 'home' so it doesn't conflict with dashboard)
$pages = ['task', 'project','team','login','mytasks','myteams','AllProjects','member','about','contactus'];
foreach ($pages as $page) {
    Route::view($page, $page)->name($page);
}

Route::get('subscriptions', [SubscriptionController::class,'index']);

// Project routes
Route::get('/project/create', [ProjectController::class, 'create'])->name('project.create');
Route::post('createproject', [ProjectController::class, 'store'])->name('project.store');
Route::get('allmyprojects', [ProjectController::class, 'index'])->name('allprojects.index');
Route::delete('delete/{project}', [ProjectController::class, 'destroy']);
Route::get('project-ai-suggestion', [ProjectController::class, 'suggestDescription'])->name('project.ai.suggest');

// Task routes
Route::get('mytasks', [TaskController::class, 'index']);
Route::get('createtask', [TaskController::class, 'create']);
Route::post('storetask', [TaskController::class, 'store']);
Route::delete('deletetask/{task}', [TaskController::class, 'destroy']);

// Team routes
Route::get('allmyteams', [TeamController::class,'index']);
Route::post('storeteam', [TeamController::class,'store']);
Route::get('toteammember', [TeamController::class,'ToTeamMember']);
Route::get('searchuser', [TeamController::class,'SearchUser']);
Route::get('addteammember/{team}', [TeamController::class,'AddTeamMember']);
Route::get('AssignTeamMember/{task}', [WorkOnController::class,'store']);
Route::delete('DeleteTeam/{team}', [TeamController::class,'destroy']);
Route::delete('DeleteTeamMember/{TeamName}/{UserId}', [TeamController::class,'DeleteTeamMember']);
Route::get('workon', [WorkOnController::class,'index']);

Route::view('test','Test.login');
Route::get('send', [SmsController::class, 'send']);
Route::post('Pay/{id}',[PaypalController::class,'Payment']);
Route::get('PaymentSuccess/{tier}',[PaypalController::class,'PaymentSuccess'])->name('PS');
Route::get('PaymentCancel',[PaypalController::class,'PaymentCancel'])->name('PC');

require __DIR__.'/admin.php';
require __DIR__.'/auth.php';