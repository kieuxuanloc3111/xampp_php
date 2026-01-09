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
use App\Http\Controllers\Admin\CountryController;

Route::prefix('admin')->name('admin.')->group(function () {
    Route::get('/country', [CountryController::class, 'index'])->name('country.index');
    Route::get('/country/create', [CountryController::class, 'create'])->name('country.create');
    Route::post('/country', [CountryController::class, 'store'])->name('country.store');

    Route::get('/country/{id}/edit', [CountryController::class, 'edit'])->name('country.edit');
    Route::put('/country/{id}', [CountryController::class, 'update'])->name('country.update');
    Route::delete('/country/{id}', [CountryController::class, 'destroy'])->name('country.destroy');
});
use App\Http\Controllers\Admin\BlogController;

Route::prefix('admin')->middleware('auth')->group(function () {

    Route::get('/blogs', [BlogController::class, 'index'])
        ->name('admin.blog.index');

    Route::get('/blogs/create', [BlogController::class, 'create'])
        ->name('admin.blog.create');

    Route::post('/blogs', [BlogController::class, 'store'])
        ->name('admin.blog.store');

    Route::get('/blogs/{id}/edit', [BlogController::class, 'edit'])
        ->name('admin.blog.edit');

    Route::put('/blogs/{id}', [BlogController::class, 'update'])
        ->name('admin.blog.update');

    Route::delete('/blogs/{id}', [BlogController::class, 'delete'])
        ->name('admin.blog.delete');
});


