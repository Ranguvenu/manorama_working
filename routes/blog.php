<?php

use App\Http\Controllers\Blog\ArticleController;
use App\Http\Controllers\Blog\AuthorController;
use Illuminate\Support\Facades\Route;

Route::prefix('blog')->name('blog.')->middleware(['auth', '2fa'])->group(function () {
    Route::prefix('author')->name('author.')->group(function () {
        Route::get('/', [AuthorController::class, 'index'])->name('index');
        Route::post('/results', [AuthorController::class, 'results'])->name('results');
        Route::post('/store', [AuthorController::class, 'store'])->name('store');
        Route::get('{author}/edit', [AuthorController::class, 'edit'])->name('edit');
        Route::put('{author}/update', [AuthorController::class, 'update'])->name('update');
        Route::delete('{author}/destroy', [AuthorController::class, 'destroy'])->name('destroy');
        Route::get('/{author}/existingauthor', [AuthorController::class, 'existingauthor'])->name('existingauthor');
    });

    Route::prefix('{category:slug}')->name('article.')->group(function () {
        Route::get('/', [ArticleController::class, 'index'])->name('index');
        Route::post('/results', [ArticleController::class, 'results'])->name('results');
        Route::get('/{article}/show', [ArticleController::class, 'show'])->name('show');
        Route::get('/create', [ArticleController::class, 'create'])->name('create');
        Route::post('/store', [ArticleController::class, 'store'])->name('store');
        Route::get('{article}/edit', [ArticleController::class, 'edit'])->name('edit');
        Route::put('{article}/update', [ArticleController::class, 'update'])->name('update');
        Route::delete('{article}/destroy', [ArticleController::class, 'destroy'])->name('destroy');
    });
});
