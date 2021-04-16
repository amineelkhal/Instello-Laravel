<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\TestController;
use App\Http\Controllers\IndexController;
use App\Http\Controllers\AuthenticationController;
use Illuminate\Support\Facades\Route;

//--- NOT CONNECTED USERS ----
Route::get('/', [IndexController::class, 'index'])->name("index");
Route::get('/register', [IndexController::class, 'register'])->name('register');
Route::post('/registerUser', [IndexController::class, 'registerUser'])->name('registeruser');

Route::post('/login', [AuthenticationController::class, 'login'])->name("login");
Route::get('/logout', [AuthenticationController::class, 'logout'])->name('logout');

//--- CONNECTED USERS ----
Route::get('/home', [HomeController::class, 'index'])->name('feed');
Route::get('/messages', [HomeController::class, 'messages'])->name('messages');
Route::get('/profile', [HomeController::class, 'profile'])->name('profile');
Route::get('/settings', [HomeController::class, 'settings'])->name('settings');
Route::post('/updateuser', [HomeController::class, 'updateUser'])->name('updateUser');
Route::post('/addpost', [HomeController::class, 'addpost'])->name('addpost');

//TESTS CONTROLLERS =============================
Route::get('/test3', [TestController::class, 'hello']);
Route::get('/test4', [TestController::class, 'create']);
Route::get('/test', [TestController::class, 'testpost']);
