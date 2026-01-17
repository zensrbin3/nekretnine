<?php

use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\PropertyController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;
use Illuminate\Foundation\Auth\EmailVerificationRequest;

Route::get('/email/verify', function () {
    return view('auth.verify-email');
})->middleware('auth')->name('verification.notice');

Route::get('/email/verify/{id}/{hash}', function (EmailVerificationRequest $request) {
    $request->fulfill();
    return redirect('/home');
})->middleware(['auth', 'signed'])->name('verification.verify');

Route::post('/email/verification-notification', function () {
    request()->user()->sendEmailVerificationNotification();
    return back();
})->middleware(['auth', 'throttle:6,1'])->name('verification.send');


Route::get('/home', function () {
    return view('home');
})->name('home');
Route::get('/', function () {
    return view('home');
})->name('home');
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
Route::get('/properties/{propertyId}', [PropertyController::class, 'show'])
    ->name('property.show');
Route::get('/profile/{userId}', [ProfileController::class, 'show'])
    ->name('profile');
Route::post('/profile/update', [ProfileController::class, 'update'])
    ->middleware('auth')
    ->name('profile.update');

Route::post('/profile/upload-photo', [UserController::class, 'uploadPhoto'])
    ->middleware('auth')
    ->name('profile.upload.photo');
//stripe

Route::get('/checkout/{name}',[CheckoutController::class, 'checkout'])
    ->name('checkout')->middleware('auth');


