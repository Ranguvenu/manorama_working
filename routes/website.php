<?php

use App\Http\Controllers\Website\PageBuilder\ComponentsController;
use App\Http\Controllers\Website\PageBuilder\PageComponentsController;
use App\Http\Controllers\Website\PageBuilder\PageController;

Route::prefix('website')->name('website.')->middleware(['auth', '2fa'])->group(function () {
    Route::prefix('pages')->name('pages.')->group(function () {
        Route::get('/', [PageController::class, 'index'])->name('index');
        Route::post('/results', [PageController::class, 'results'])->name('results');
        Route::get('/create', [PageController::class, 'create'])->name('create');
        Route::post('/store', [PageController::class, 'store'])->name('store');
        Route::get('/{page}/edit', [PageController::class, 'edit'])->name('edit');
        Route::post('/{page}/update', [PageController::class, 'update'])->name('update');
        Route::post('/{page}/publish', [PageController::class, 'publish'])->name('publish');
        Route::post('/components', [PageController::class, 'components'])->name('components');
        Route::delete('/{page}/destroy', [PageController::class, 'destroy'])->name('destroy');
        // Route::get('/{page}/design', [PageComponentsController::class, 'index'])->name('design');
        Route::prefix('/{page}/design')->name('components.')->group(function () {
            Route::get('/', [PageComponentsController::class, 'index'])->name('index');
            Route::get('/show', [PageComponentsController::class, 'show'])->name('show');
            Route::get('{component}/clone', [PageComponentsController::class, 'clone'])->name('clone');
            Route::get('{component}/visibility/{visible}', [PageComponentsController::class, 'update_visibility'])->name('visibility');
            Route::get('/create', [PageComponentsController::class, 'create'])->name('create');
            Route::post('/store', [PageComponentsController::class, 'store'])->name('store');
            Route::post('/positions', [PageComponentsController::class, 'update_position'])->name('positions');
            Route::post('/{component}/update', [PageComponentsController::class, 'update'])->name('update');
            Route::delete('/{component}/destroy', [PageComponentsController::class, 'destroy'])->name('destroy');
        });
    });
});
Route::prefix('website')->name('website.')->group(function () {
    Route::prefix('components')->name('components.')->group(function () {
        Route::post('{component:slug}/index', [ComponentsController::class, 'index'])->name('index');
        Route::any('{component:slug}/create', [ComponentsController::class, 'create'])->name('create');
        Route::post('{component:slug}/show', [ComponentsController::class, 'show'])->name('show');
        Route::post('{component:slug}/download', [ComponentsController::class, 'download'])->name('download');
    });
});
