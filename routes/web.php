<?php

use App\Http\Controllers\ReminderController;
use App\Http\Controllers\UserController;
use App\Models\User;
use Illuminate\Support\Facades\Route;

// home
Route::get('/', function () {
    return view('home');
})->name('home');

Route::get('/dashboard', function () {
    return view('dashboard');
})->name('dashboard');

// logout
Route::get('/logout', [UserController::class, 'logout'])->name('logout');

Route::middleware('auth')->group(function () {
    // reminder
    Route::prefix('/reminder')->name('reminder.')->group(function () {
        // index
        Route::get('/', [ReminderController::class, 'index'])->name('index');
        // create
        Route::post('/store', [UserController::class, 'store'])->name('store');
    });
});

// isAdmin
Route::middleware('isAdmin')->prefix('/admin')->name('admin.')->group(function () {
    Route::get('/dashboard', function () {
        return view('admin.dashboard');
    })->name('dashboard');

    // data user
    Route::prefix('/users')->name('users.')->group(function () {
        // index
        Route::get('/', [UserController::class, 'index'])->name('index');
        // create
        Route::post('/store', [UserController::class, 'store'])->name('store');
        // edit
        Route::get('/edit/{id}', [UserController::class, 'edit'])->name('edit');
        // update
        Route::put('/update/{id}', [UserController::class, 'update'])->name('update');
        // delete
        Route::delete('/delete/{id}', [UserController::class, 'destroy'])->name('delete');
        // trash
        Route::get('/trash', [UserController::class, 'trash'])->name('trash');
        // restore
        Route::patch('/restore/{id}', [UserController::class, 'restore'])->name('restore');
        // delete permanen
        Route::delete('/delete-permanent/{id}', [UserController::class, 'deletePermanent'])->name('delete_permanent');
        // export
        Route::get('/export', [UserController::class, 'export'])->name('export');
        // datatables
        Route::get('/datatables', [UserController::class, 'datatables'])->name('datatables');
    });
});

// isGuest
Route::middleware('isGuest')->group(function () {
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
