<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProductController;

use App\Http\Controllers\CauthuController;
use App\Http\Controllers\Home1Controller;
Route::get('/products', [ProductController::class, 'index']);
Route::get('/products/create', [ProductController::class, 'create']);
Route::post('/products', [ProductController::class, 'store']);

Route::get('/products/{id}/edit', [ProductController::class, 'edit']);
Route::put('/products/{id}', [ProductController::class, 'update']);
Route::delete('/products/{id}', [ProductController::class, 'destroy']);

Route::get('/', [HomeController::class, 'index']);

Route::get('/home1', [Home1Controller::class, 'index']);

Route::middleware('auth')->group(function () {

    Route::get('/cauthu', [CauthuController::class, 'index']);
    Route::get('/cauthu/create', [CauthuController::class, 'create']);
    Route::post('/cauthu/store', [CauthuController::class, 'store']);

    Route::get('/cauthu/edit/{id}', [CauthuController::class, 'edit']);
    Route::post('/cauthu/update/{id}', [CauthuController::class, 'update']);

    Route::get('/cauthu/delete/{id}', [CauthuController::class, 'destroy']);

});




// Route::get('/login', [HomeController::class, 'login']);
// Route::post('/login', [HomeController::class, 'handleLogin']);

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
