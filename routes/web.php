<?php

use App\Http\Controllers\DashboardController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    Route::get('/passwd/create', [DashboardController::class, 'create'])->name('password.create');
    Route::post('/passwd/store', [DashboardController::class, 'store'])->name('password.store');
    Route::get('/passwd/edit/{id}', [DashboardController::class, 'edit'])->name('password.edit');
    Route::put('/passwd/update/{id}', [DashboardController::class, 'update'])->name('password.update');
    Route::get('/passwd/delete/{id}', [DashboardController::class, 'delete'])->name('password.delete');
    Route::get('/passwords/{id}', [DashboardController::class, 'show'])->name('passwords.show');

    // clear route
    Route::get('/clear', function () {
        Artisan::call('config:clear');
        Artisan::call('cache:clear');
        Artisan::call('config:cache');
        Artisan::call('view:clear');
        return "Cleared!";
    });
});
