<?php

use App\Http\Controllers\LeadManagement\ContactUsRequestsController;
use App\Http\Controllers\LeadManagement\LeadPromoCodesController;
use App\Http\Controllers\LeadManagement\LeadsController;
use App\Http\Controllers\LeadManagement\NewsletterSubscriptionsController;
use App\Http\Controllers\LeadManagement\UserResponseController;

Route::prefix('leads')->name('leads.')->middleware(['auth', '2fa'])->group(function () {
    Route::prefix('{category:slug}')->name('category.')->group(function () {
        Route::get('/', [LeadsController::class, 'index'])->name('index');
        Route::post('/results', [LeadsController::class, 'results'])->name('results');
        Route::get('/create', [LeadsController::class, 'create'])->name('create');
        Route::post('/store', [LeadsController::class, 'store'])->name('store');
        Route::get('{interested}/show', [LeadsController::class, 'show'])->name('show');
        Route::get('{interested}/edit', [LeadsController::class, 'edit'])->name('edit');
        Route::put('{interested}/update', [LeadsController::class, 'update'])->name('update');
        Route::get('{lead}/disqualify', [LeadsController::class, 'disqualify'])->name('disqualify');
        Route::get('{lead}/undisqualify', [LeadsController::class, 'undisqualify'])->name('undisqualify');
        Route::get('/{interested}/agent/{agent}/assign', [LeadsController::class, 'assign'])->name('assign');
        Route::patch('/{interested}/agent/{agent}/unassign', [LeadsController::class, 'unassign'])->name('unassign');
    });
    Route::prefix('responses')->name('responses.')->group(function () {
        Route::get('{interests}', [UserResponseController::class, 'index'])->name('index');
        Route::post('{interests}/store', [UserResponseController::class, 'store'])->name('store');
    });
    Route::prefix('promocode')->name('promocode.')->group(function () {
        Route::post('{interests}', [LeadPromoCodesController::class, 'index'])->name('index');
        Route::post('{interests}/send', [LeadPromoCodesController::class, 'send'])->name('send');
    });
});

Route::prefix('newsletter')->name('newsletter.')->group(function () {
    Route::get('/', [NewsletterSubscriptionsController::class, 'index'])->middleware('auth')->name('index');
    Route::post('/results', [NewsletterSubscriptionsController::class, 'results'])->middleware('auth')->name('results');
    Route::post('/store', [NewsletterSubscriptionsController::class, 'store'])->name('store');
});

Route::prefix('contact')->name('contact.')->group(function () {
    Route::get('/', [ContactUsRequestsController::class, 'index'])->middleware('auth')->name('index');
    Route::post('/results', [ContactUsRequestsController::class, 'results'])->middleware('auth')->name('results');
    Route::post('/store', [ContactUsRequestsController::class, 'store'])->name('store');
});
