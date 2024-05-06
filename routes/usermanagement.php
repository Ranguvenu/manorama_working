<?php

use App\Http\Controllers\UserManagement\RolesController;
use App\Http\Controllers\UserManagement\UploadUsersController;
use App\Http\Controllers\UserManagement\UserController;

Route::prefix('users')->name('users.')->middleware(['auth', '2fa'])->group(function () {
    Route::get('/role/{role:name}', [UserController::class, 'users_role'])->name('show');
    Route::prefix('roles')->name('roles.')->group(function () {
        Route::get('/', [RolesController::class, 'index'])->name('index');
        Route::post('/results', [RolesController::class, 'results'])->name('results');
        Route::get('/create', [RolesController::class, 'create'])->name('create');
        Route::get('/{role}/edit', [RolesController::class, 'edit'])->name('edit');
        Route::post('/store', [RolesController::class, 'store'])->name('store');
        Route::put('/{role}/update', [RolesController::class, 'update'])->name('update');
        Route::delete('/{role}/destroy', [RolesController::class, 'destroy'])->name('destroy');
    });
    Route::prefix('{category:slug}')->name('type.')->group(function () {
        Route::get('/', [UserController::class, 'index'])->name('index');
        Route::post('/results', [UserController::class, 'results'])->name('results');
        Route::get('/create', [UserController::class, 'create'])->name('create');
        Route::get('{user}/show', [UserController::class, 'show'])->name('show');
        Route::get('{user}/edit', [UserController::class, 'edit'])->name('edit');
        Route::post('/store', [UserController::class, 'store'])->name('store');
        Route::put('{user}/update', [UserController::class, 'update'])->name('update');
        Route::delete('{user}/destroy', [UserController::class, 'destroy'])->name('destroy');
        Route::get('{user}/activate', [UserController::class, 'activate'])->name('activate');
        // Route::post('/storeuploadusers', [UploadUsersController::class, 'store'])->name('store');
    });
    Route::put('{user}/reset', [UserController::class, 'reset'])->name('reset');
});
