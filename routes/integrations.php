<?php

use App\Http\Controllers\Integrations\MMHSSOController;
use App\Http\Controllers\Integrations\MoodleSSOController;
use App\Http\Controllers\Integrations\RaalinkController;
use App\Http\Controllers\Integrations\SAPController;

Route::prefix('integrations')->name('integrations.')->middleware('auth')->group(function () {
    Route::get('lms', [MoodleSSOController::class, 'lms'])->name('lms');
    Route::get('redirect', [MoodleSSOController::class, 'redirect_on_login'])->name('redirect');
    Route::prefix('sso')->name('sso.')->group(function () {
        Route::post('test_connection', [MoodleSSOController::class, 'test_connection'])->name('test.connection');
        Route::get('login/{course?}', [MoodleSSOController::class, 'login'])->name('login');
        Route::get('logout', [MoodleSSOController::class, 'logout'])->name('logout');
    });
    Route::prefix('raalink')->name('raalink.')->group(function () {
        Route::post('call/{interest}', [RaalinkController::class, 'call_user'])->name('call');
        Route::get('capture/{caller:call_id}', [RaalinkController::class, 'capture'])->name('capture');
    });
    Route::prefix('sap')->name('sap.')->group(function () {
        Route::get('/', [SAPController::class, 'index'])->name('index');
        Route::post('/results', [SAPController::class, 'results'])->name('results');
        Route::get('{sapdata}/edit', [SAPController::class, 'edit'])->name('edit');
        Route::put('{sapdata}/update', [SAPController::class, 'update'])->name('update');
    });
});

Route::prefix('integrations')->name('integrations.')->group(function () {
    Route::prefix('mhsso')->name('mhsso.')->group(function () {
        Route::get('/authorize', [MMHSSOController::class, 'redirect'])->name('authorize');
        Route::get('/callback', [MMHSSOController::class, 'authenticate'])->name('authenticate');
    });
});
