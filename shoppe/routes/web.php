<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});


Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\UserController;

Route::prefix('admin')
    ->middleware(['auth'])
    ->group(function () {

        Route::get('/dashboard', [DashboardController::class, 'index'])
            ->name('admin.dashboard');

        Route::get('/profile', [UserController::class, 'profile'])
            ->name('admin.profile');

        Route::post('/profile', [UserController::class, 'update'])
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
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\BrandController;

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
    // CATEGORY

// CATEGORY
    Route::get('/category', [CategoryController::class, 'index'])
        ->name('admin.category.index');

    Route::get('/category/create', [CategoryController::class, 'create'])
        ->name('admin.category.create');

    Route::post('/category', [CategoryController::class, 'store'])
        ->name('admin.category.store');

    Route::get('/category/{id}/edit', [CategoryController::class, 'edit'])
        ->name('admin.category.edit');

    Route::put('/category/{id}', [CategoryController::class, 'update'])
        ->name('admin.category.update');

    Route::get('/category/{id}/delete', [CategoryController::class, 'destroy'])
        ->name('admin.category.delete');


    // BRAND
// BRAND
    Route::get('/brand', [BrandController::class, 'index'])
        ->name('admin.brand.index');

    Route::get('/brand/create', [BrandController::class, 'create'])
        ->name('admin.brand.create');

    Route::post('/brand', [BrandController::class, 'store'])
        ->name('admin.brand.store');

    Route::get('/brand/{id}/edit', [BrandController::class, 'edit'])
        ->name('admin.brand.edit');

    Route::put('/brand/{id}', [BrandController::class, 'update'])
        ->name('admin.brand.update');

    Route::get('/brand/{id}/delete', [BrandController::class, 'destroy'])
        ->name('admin.brand.delete');
    
    });


use App\Http\Controllers\Frontend\AuthController;
use App\Http\Controllers\Frontend\ProductController;
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

Route::middleware('auth')->prefix('member')->group(function () {

    Route::post('/logout', [AuthController::class, 'logout'])
        ->name('member.logout');

    Route::get('/profile', [AuthController::class, 'profileForm'])
        ->name('member.profile');

    Route::post('/profile', [AuthController::class, 'updateProfile'])
        ->name('member.profile.update');

    // PRODUCT
    Route::get('/add-product', [ProductController::class, 'create'])
        ->name('member.product.add');

    Route::post('/add-product', [ProductController::class, 'store'])
        ->name('member.product.store');

    Route::get('/my-product', [ProductController::class, 'myProduct'])
        ->name('member.product.my');
        
    Route::get('/product/{id}/edit', [ProductController::class, 'edit'])
        ->name('member.product.edit');

    Route::post('/product/{id}/update', [ProductController::class, 'update'])
        ->name('member.product.update');    
    Route::get('/product/{id}/delete', [ProductController::class, 'destroy'])
        ->name('member.product.delete');         
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
use App\Http\Controllers\Frontend\HomeController;

Route::get('/member/home', [HomeController::class, 'index'])
    ->name('member.home');