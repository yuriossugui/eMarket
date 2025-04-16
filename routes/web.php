<?php

use App\Http\Controllers\Admin\ClientController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\LoginController;

Route::get('/', function () {
    return view('welcome');
})->name('home');

Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::get('/register', [LoginController::class, 'showRegisterForm'])->name('register');
Route::post('/register', [LoginController::class, 'store'])->name('register.store');
Route::post('/login', [LoginController::class, 'auth'])->name('login.post');
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

// product routes
Route::get('/admin/product-index', [ProductController::class, 'index'])->name('product.index');
Route::post('/admin/create-product', [ProductController::class, 'create'])->name('create.product');
Route::post('/admin/create-category', [ProductController::class, 'createCategory'])->name('create.category');
Route::get('/admin/product-show/{id}', [ProductController::class, 'show']);
Route::put('/admin/product-edit/{id}', [ProductController::class, 'edit']);
Route::delete('/admin/product-destroy', [ProductController::class, 'delete'])->name('destroy.product');


// client routes
Route::get('/admin/client-index', [ClientController::class, 'index'])->name('client.index');
