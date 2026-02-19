<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TodoController;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\InvitationController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\PasswordResetController;


Route::get('/', function () {
    return view('auth.start');
});

//dashboard
Route::get('/dashboard', [DashboardController::class, 'index'])
    ->middleware('auth')
    ->name('dashboard');

// Todo
Route::resource('todos', TodoController::class)->middleware('auth');

Route::patch('todos/{todo}/status', 
    [TodoController::class, 'updateStatus']
)->name('todos.status');

//Project
Route::resource('projects', ProjectController::class)->middleware('auth');
Route::post('projects/{project}/invite',[ProjectController::class, 'invite'])->name('projects.invite')->middleware('auth');


//InvitationController
Route::get('invitations/{invitation}',[InvitationController::class, 'show'])->middleware('auth')->name('invitations.show');

Route::post('invitations/{invitation}/accept',[InvitationController::class, 'accept'])->middleware('auth')->name('invitations.accept');

Route::post('invitations/{invitation}/decline',[InvitationController::class, 'decline'])->middleware('auth')->name('invitations.reject');


//Auth

// Login
Route::get('/login', [LoginController::class, 'show'])->name('login');
Route::post('/login', [LoginController::class, 'login']);
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

// Register
Route::get('/register', [RegisterController::class, 'show'])->name('register');
Route::post('/register', [RegisterController::class, 'register']);

// Verify Email
Route::get('/verify-email', [RegisterController::class, 'verifyPage'])->name('verify.page');
Route::post('/verify-email', [RegisterController::class, 'verifyCode'])->name('verify.code');

// Resend code
Route::post('/resend-code', [RegisterController::class, 'resendCode'])->name('resend.code');

// Forgot password
Route::get('/forgot-password', [PasswordResetController::class, 'requestForm'])->name('password.request');
Route::post('/forgot-password', [PasswordResetController::class, 'send'])->name('password.email');

// Reset password
Route::get('/reset-password/{token}', [PasswordResetController::class, 'form'])->name('password.reset');
Route::post('/reset-password', [PasswordResetController::class, 'update'])->name('password.update');