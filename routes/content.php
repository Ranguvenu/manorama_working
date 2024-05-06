<?php

use App\Http\Controllers\Content\DownloadableResourcesController;
use App\Http\Controllers\Content\StudyMaterialsController;
use App\Http\Controllers\Content\VideolistController;
use App\Http\Controllers\Content\WebinarsController;

Route::prefix('content')->name('content.')->middleware(['auth', '2fa'])->group(function () {
    Route::prefix('resources')->name('resources.')->group(function () {
        Route::get('/', [DownloadableResourcesController::class, 'index'])->name('index');
        Route::post('/results', [DownloadableResourcesController::class, 'results'])->name('results');
        Route::get('/create', [DownloadableResourcesController::class, 'create'])->name('create');
        Route::post('/store', [DownloadableResourcesController::class, 'store'])->name('store');
        Route::get('{resource}/edit', [DownloadableResourcesController::class, 'edit'])->name('edit');
        Route::put('{resource}/update', [DownloadableResourcesController::class, 'update'])->name('update');
        Route::delete('{resource}/destroy', [DownloadableResourcesController::class, 'destroy'])->name('destroy');
    });
    Route::prefix('webinars')->name('webinars.')->group(function () {
        Route::get('/', [WebinarsController::class, 'index'])->name('index');
        Route::post('/results', [WebinarsController::class, 'results'])->name('results');
        Route::get('/create', [WebinarsController::class, 'create'])->name('create');
        Route::post('/store', [WebinarsController::class, 'store'])->name('store');
        Route::get('{webinar}/edit', [WebinarsController::class, 'edit'])->name('edit');
        Route::put('{webinar}/update', [WebinarsController::class, 'update'])->name('update');
        Route::delete('{webinar}/destroy', [WebinarsController::class, 'destroy'])->name('destroy');
    });
    Route::prefix('studymaterial')->name('studymaterial.')->group(function () {
        Route::get('/', [StudyMaterialsController::class, 'index'])->name('index');
        Route::get('/create', [StudyMaterialsController::class, 'create'])->name('create');
        Route::post('/store', [StudyMaterialsController::class, 'store'])->name('store');
        Route::post('/results', [StudyMaterialsController::class, 'results'])->name('results');
        Route::get('{studymaterial}/edit', [StudyMaterialsController::class, 'edit'])->name('edit');
        Route::put('{studymaterial}/update', [StudyMaterialsController::class, 'update'])->name('update');
        Route::delete('{studymaterial}/destroy', [StudyMaterialsController::class, 'destroy'])->name('destroy');
    });
    Route::prefix('videolist')->name('videolist.')->group(function () {
        Route::get('/', [VideolistController::class, 'index'])->name('index');
        Route::get('/create', [VideolistController::class, 'create'])->name('create');
        Route::post('/store', [VideolistController::class, 'store'])->name('store');
        Route::post('/results', [VideolistController::class, 'results'])->name('results');
        Route::get('{videolist}/edit', [VideolistController::class, 'edit'])->name('edit');
        Route::put('{videolist}/update', [VideolistController::class, 'update'])->name('update');
        Route::delete('{videolist}/destroy', [VideolistController::class, 'destroy'])->name('destroy');
    });
});
