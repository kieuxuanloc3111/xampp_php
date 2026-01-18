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
use App\Http\Controllers\Admin\BlogController as AdminBlogController;
use App\Http\Controllers\Frontend\BlogController as FrontendBlogController;


Route::prefix('admin')->middleware('auth')->group(function () {

    Route::get('/blogs', [AdminBlogController::class, 'index'])
        ->name('admin.blog.index');

    Route::get('/blogs/create', [AdminBlogController::class, 'create'])
        ->name('admin.blog.create');

    Route::post('/blogs', [AdminBlogController::class, 'store'])
        ->name('admin.blog.store');

    Route::get('/blogs/{id}/edit', [AdminBlogController::class, 'edit'])
        ->name('admin.blog.edit');

    Route::put('/blogs/{id}', [AdminBlogController::class, 'update'])
        ->name('admin.blog.update');

    Route::get('/blogs/{id}/delete', [AdminBlogController::class, 'destroy'])
        ->name('admin.blog.delete');
});


use App\Http\Controllers\Frontend\AuthController;

Route::prefix('member')->group(function () {

    Route::get('/register', [AuthController::class, 'registerForm'])
        ->name('member.register');

    Route::post('/register', [AuthController::class, 'register'])
        ->name('member.register.post');

    Route::get('/login', [AuthController::class, 'loginForm'])
        ->name('member.login');

    Route::post('/login', [AuthController::class, 'login'])
        ->name('member.login.post');

});

Route::get('/blog', [FrontendBlogController::class, 'index'])
    ->name('member.blog.index');

Route::get('/blog/{id}', [
    FrontendBlogController::class,
    'detail'
])->name('member.blog.detail');

Route::post('/blog/rate', [
    FrontendBlogController::class,
    'rate'
])->name('blog.rate');
use App\Http\Controllers\Frontend\CommentController;

Route::post('/blog/comment', [CommentController::class, 'store'])
    ->name('blog.comment');
