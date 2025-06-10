<?php

use App\Http\Controllers\Admin\ClientController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\Store\StoreController;

// Route::get('/', [StoreController::class, 'index'])->name('home')->middleware('auth');

Route::get('/', [ProductController::class, 'index'])->name('home')->middleware('auth');

Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::get('/register', [LoginController::class, 'showRegisterForm'])->name('register');
Route::post('/register', [LoginController::class, 'store'])->name('register.store');
Route::post('/login', [LoginController::class, 'auth'])->name('login.post');
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');


Route::middleware(['auth'])->group(function () {
    // product routes
    Route::get('/admin/product-index', [ProductController::class, 'index'])->name('product.index');
    Route::post('/admin/create-product', [ProductController::class, 'create'])->name('create.product');
    Route::post('/admin/create-category', [ProductController::class, 'createCategory'])->name('create.category');
    Route::get('/admin/product-show/{id}', [ProductController::class, 'show']);
    Route::put('/admin/product-edit/{id}', [ProductController::class, 'edit']);
    Route::delete('/admin/product-destroy', [ProductController::class, 'delete'])->name('destroy.product');
    
    // client routes
    Route::get('/admin/client-index', [ClientController::class, 'index'])->name('client.index');
    Route::post('/admin/create-client', [ClientController::class, 'create'])->name('create.client');
    Route::get('/admin/client-show/{id}', [ClientController::class, 'show'])->name('client.show');
    Route::put('/admin/client-update/{id}', [ClientController::class, 'update']);
    Route::delete('/admin/client-delete', [ClientController::class, 'delete'])->name('client.delete');

    // category routes
    Route::get('/admin/category-index', [CategoryController::class, 'index'])->name('category.index');
    Route::get('/admin/category-show/{id}', [CategoryController::class, 'show'])->name('category.show');
    Route::put('/admin/category-update/{id}', [CategoryController::class, 'update']);
    Route::delete('/admin/category-delete', [CategoryController::class, 'delete'])->name('category.delete');

    // movement
    Route::get('/admin/inbound', [ProductController::class, 'inbound'])->name('movement.inbound');
    Route::post('/admin/register-entry', [ProductController::class, 'entry']);
    Route::get('/admin/outbound', [ProductController::class, 'outbound'])->name('movement.outbound');
    Route::post('/admin/register-output', [ProductController::class, 'output']);

    // stock
    Route::get('/admin/storage-index', [ProductController::class, 'storage'])->name('storage.index');

    // dashboard
    Route::get('/admin/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // client 
    Route::get('/admin/user-index', [UserController::class, 'index'])->name('user.index');
    Route::get('/admin/user-show/{id}', [UserController::class, 'show'])->name('user.show');
    Route::put('/admin/user-update/{id}', [UserController::class, 'update']);
    Route::delete('/admin/user-destroy', [UserController::class, 'delete'])->name('user.delete');
});

