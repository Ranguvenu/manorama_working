<?php
use App\Http\Controllers\Migrations\UsersMigrationController;

Route::prefix('migrations')->name('migrations.')->middleware('auth')->group(function () {
    Route::prefix('{taxonomy}')->name('{taxonomy}.')->group(function () {
        Route::get('/', [UsersMigrationController::class, 'index'])->name('index');
    });
});
