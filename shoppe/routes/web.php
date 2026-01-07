<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});


Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\UserController;

Route::middleware('auth')->group(function () {

    Route::get('/admin', [DashboardController::class, 'index'])
        ->name('admin.dashboard');

    Route::get('/admin/profile', [UserController::class, 'profile'])
        ->name('admin.profile');

    Route::post('/admin/profile', [UserController::class, 'update'])
        ->name('admin.profile.update');
});
