<?php

use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('home');
})->name('home');





Route::get('/logout', [UserController::class, 'logout'])->name('logout');

// isAdmin
Route::middleware('isAdmin')->prefix('/admin')->name('admin.')->group(function () {
    Route::get('/dashboard', function () {
        return view('admin.dashboard');
    })->name('dashboard');
});

// isGuest
Route::middleware('isGuest')->prefix('/guest')->name('guest.')->group(function () {
    // login
    Route::get('/login', function () {
        return view('login');
    })->name('login');

    Route::post('/login', [UserController::class, 'loginAuth'])->name('login.auth');

    Route::post('/sign-up', [UserController::class, 'SignUp'])->name('sign_up.add');

    // signup
    Route::get('/sign-up', function () {
        return view('signup');
    })->name('signup');
});
