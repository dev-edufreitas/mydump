<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BlogController;
use App\Http\Controllers\Admin\PostController;
use App\Http\Controllers\Admin\CategoryController;

// Include authentication routes
require __DIR__.'/auth.php';

// Blog routes (público)
Route::get('/', [BlogController::class, 'index'])->name('blog.index');
Route::get('/post/{post:slug}', [BlogController::class, 'show'])->name('blog.show');
Route::get('/category/{category:slug}', [BlogController::class, 'category'])->name('blog.category');
Route::post('/post/{post}/comment', [BlogController::class, 'storeComment'])->name('blog.comment.store');

// Admin routes (protegidas por autenticação)
Route::middleware(['auth'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/', function () {
        return redirect()->route('admin.posts.index');
    });
    
    Route::resource('posts', PostController::class);
    Route::resource('categories', CategoryController::class)->except(['show']);
});

// Rota de fallback para páginas antigas
Route::fallback(function () {
    return view('/');
});
