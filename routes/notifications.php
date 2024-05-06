<?php

use App\Http\Controllers\Notifications\Logs\EmailLogsController;
use App\Http\Controllers\Notifications\Logs\SmsLogsController;
use App\Http\Controllers\Notifications\NotificationSettingsController;
use App\Http\Controllers\Notifications\Templates\EmailTemplateController;
use App\Http\Controllers\Notifications\Templates\SMSTemplateController;

Route::prefix('notifications')->name('notifications.')->middleware(['auth', '2fa'])->group(function () {
    Route::prefix('template')->group(function () {
        Route::prefix('sms')->name('sms.')->group(function () {
            Route::get('/', [SMSTemplateController::class, 'index'])->name('index');
            Route::post('/results', [SMSTemplateController::class, 'results'])->name('results');
            Route::get('/create', [SMSTemplateController::class, 'create'])->name('create');
            Route::get('/{smstemplate}/edit', [SMSTemplateController::class, 'edit'])->name('edit');
            Route::post('/store', [SMSTemplateController::class, 'store'])->name('store');
            Route::put('/{smstemplate}/update', [SMSTemplateController::class, 'update'])->name('update');
            Route::delete('/{smstemplate}/destroy', [SMSTemplateController::class, 'destroy'])->name('destroy');
        });

        Route::prefix('email')->name('email.')->group(function () {
            Route::get('/', [EmailTemplateController::class, 'index'])->name('index');
            Route::post('/results', [EmailTemplateController::class, 'results'])->name('results');
            Route::get('/create', [EmailTemplateController::class, 'create'])->name('create');
            Route::get('/{emailtemplate}/edit', [EmailTemplateController::class, 'edit'])->name('edit');
            Route::post('/store', [EmailTemplateController::class, 'store'])->name('store');
            Route::put('/{emailtemplate}/update', [EmailTemplateController::class, 'update'])->name('update');
            Route::delete('/{emailtemplate}/destroy', [EmailTemplateController::class, 'destroy'])->name('destroy');
        });
    });
    Route::prefix('logs')->group(function () {
        Route::prefix('email')->name('email.')->group(function () {
            Route::get('/', [EmailLogsController::class, 'index'])->name('index');
            Route::post('/results', [EmailLogsController::class, 'results'])->name('results');
        });
        Route::prefix('sms')->name('sms.')->group(function () {
            Route::get('/', [SmsLogsController::class, 'index'])->name('index');
            Route::post('/results', [SmsLogsController::class, 'results'])->name('results');
        });
    });
    Route::prefix('settings')->name('settings.')->group(function () {
        Route::get('/', [NotificationSettingsController::class, 'index'])->name('index');
        Route::post('/results', [NotificationSettingsController::class, 'results'])->name('results');
        Route::get('{setting}/edit', [NotificationSettingsController::class, 'edit'])->name('edit');
        Route::put('/{setting}/update', [NotificationSettingsController::class, 'update'])->name('update');
    });
});
