<?php

use App\Http\Controllers\LoginController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\PropertyController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::get('/home', function () {
    return view('home');
});
Route::get('/', function () {
    return view('home');
});
Route::get('/register', [RegisterController::class, 'index'])
->name('register');
Route::post('/register', [RegisterController::class, 'store'])
    ->name('register.store');
Route::get('/login', [LoginController::class, 'index'])
    ->name('login');
Route::post('/login', [LoginController::class, 'store'])
    ->name('login.store');
Route::get('/logout', [LoginController::class, 'destroy'])
    ->name('logout');
Route::post('addProperty',[PropertyController::class, 'store'])
    ->name('property.store');
Route::get('/properties', [PropertyController::class, 'index'])
    ->name('property.index');
Route::get('/profile/{userId}', [ProfileController::class, 'show'])
    ->name('profile');
Route::post('/profile/upload-photo', [UserController::class, 'uploadPhoto'])
    ->name('profile.upload.photo');


