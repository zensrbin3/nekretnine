<?php

use App\Http\Controllers\LoginController;
use App\Http\Controllers\PropertyController;
use App\Http\Controllers\RegisterController;
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
