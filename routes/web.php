<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\PostController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\HomeController;


Route::get('/', fn () => redirect('/admin'));

Auth::routes();

Route::get('/home', [HomeController::class, 'index'])->name('home');

Route::middleware(['auth', 'admin'])->prefix('admin')->group(function () {

    Route::get('/posts', [PostController::class, 'index'])->name('posts.index');
    Route::get('/posts/create', [PostController::class, 'create'])->name('posts.create');
    Route::post('/posts/save', [PostController::class, 'save'])->name('posts.save');
    Route::get('/posts/edit/{post}', [PostController::class, 'edit'])->name('posts.edit');
    Route::get('/posts/delete/{post}', [PostController::class, 'delete'])->name('posts.delete');

    Route::get('/categories', [CategoryController::class, 'index'])->name('categories.index');
    Route::get('/categories/create', [CategoryController::class, 'create'])->name('categories.create');
    Route::post('/categories/save', [CategoryController::class, 'save'])->name('categories.save');
    Route::get('/categories/edit/{category}', [CategoryController::class, 'edit'])->name('categories.edit');
    Route::get('/categories/delete/{category}', [CategoryController::class, 'delete'])->name('categories.delete');
});


Route::fallback(function () {
    return response()->view('errors.404', [], 404);
});