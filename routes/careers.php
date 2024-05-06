<?php

use App\Http\Controllers\Careers\JobApplicationController;
use App\Http\Controllers\Careers\JobPostingController;
use Illuminate\Support\Facades\Route;

Route::prefix('careers')->name('careers.')->middleware('auth')->group(function () {
    Route::prefix('jobs')->name('jobs.')->middleware('2fa')->group(function () {
        Route::get('/', [JobPostingController::class, 'index'])->name('index');
        Route::post('/results', [JobPostingController::class, 'results'])->name('results');
        Route::get('/create', [JobPostingController::class, 'create'])->name('create');
        Route::post('/store', [JobPostingController::class, 'store'])->name('store');
        Route::get('{job}/edit', [JobPostingController::class, 'edit'])->name('edit');
        Route::put('{job}/update', [JobPostingController::class, 'update'])->name('update');
        Route::delete('{job}/destroy', [JobPostingController::class, 'destroy'])->name('destroy');
    });
    Route::prefix('{job:slug}')->name('job.')->group(function () {
        // Route::get('/', [JobApplicationController::class, 'create'])->name('create');
        Route::post('/store', [JobApplicationController::class, 'store'])->name('store');
        Route::prefix('applications')->name('applications.')->group(function () {
            Route::get('/', [JobApplicationController::class, 'index'])->name('index');
            Route::post('/results', [JobApplicationController::class, 'results'])->name('results');
        });
    });
    Route::prefix('application')->middleware('2fa')->name('application.')->group(function () {
        Route::post('{application}/show', [JobApplicationController::class, 'show'])->name('show');
        Route::post('{application}/update', [JobApplicationController::class, 'update'])->name('update');
        Route::get('{application}/status/{status}', [JobApplicationController::class, 'update_status'])->name('status');
    });
});

Route::prefix('careers')->name('careers.')->group(function () {
    Route::prefix('{job:slug}')->name('job.')->group(function () {
        Route::get('/', [JobApplicationController::class, 'create'])->name('create');
    });
});
