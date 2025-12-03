<?php

use App\Http\Controllers\ReminderController;
use App\Http\Controllers\UserController;

use Illuminate\Support\Facades\Route;

// home
Route::get('/', function () {
    return view('home');
})->name('home');

// logout
Route::get('/logout', [UserController::class, 'logout'])->name('logout');

Route::middleware('auth')->group(function () {
    Route::get('/dashboard', [ReminderController::class, 'dashboardPage'])->name('dashboard');

    // reminder
    Route::prefix('/reminder')->name('reminder.')->group(function () {
        // index
        Route::get('/', [ReminderController::class, 'index'])->name('index');
        // create
        Route::post('/store', [ReminderController::class, 'store'])->name('store');
        // show
        Route::get('/{id}', [ReminderController::class, 'show'])->name('show');
        // edit
        Route::get('/edit/{id}', [ReminderController::class, 'edit'])->name('edit');
        // update
        Route::put('/update/{id}', [ReminderController::class, 'update'])->name('update');
        // delete
        Route::delete('/destroy/{id}', [ReminderController::class, 'destroy'])->name('destroy');
        // toggle reminder
        Route::put('/{id}/toggle', [ReminderController::class, 'toggle'])->name('toggle');
        // export pdf
        Route::get('/report/pdf', [ReminderController::class, 'exportDashboardPdf'])->name('report.pdf');
    });

    // profile
    Route::prefix('/user')->name('user.')->group(function () {
        // settings
        Route::get('/settings', [UserController::class, 'settings'])->name('settings');
        // update
        Route::post('/settings', [UserController::class, 'updateProfile'])->name('update_profile');
        // delete
        Route::delete('/delete', [UserController::class, 'deleteAccount'])->name('delete_account');
        // profile
        Route::get('/profile', [UserController::class, 'profile'])->name('profile');
        // account
        Route::get('/account', [UserController::class, 'account'])->name('account');
    });
});

// isAdmin
Route::middleware('isAdmin')->prefix('/admin')->name('admin.')->group(function () {
    Route::get('/reminders/chart', [UserController::class, 'chartData'])->name('reminders.chart');

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
