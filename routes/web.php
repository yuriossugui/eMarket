<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\Admin\CategoryController;


Route::get('/', function () {
    return view('welcome');
})->name('home');

Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::get('/register', [LoginController::class, 'showRegisterForm'])->name('register');
Route::post('/register', [LoginController::class, 'store'])->name('register.store');
Route::post('/login', [LoginController::class, 'auth'])->name('login.post');
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

Route::get('/admin/product-index', [ProductController::class, 'index'])->name('product.index');
Route::get('/admin/product-create-form', [ProductController::class, 'createForm'])->name('product.create.form')->middleware('auth');

Route::get('/admin/category-index', [CategoryController::class, 'index'])->name('category.index')->middleware('auth');