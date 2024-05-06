<?php

use App\Http\Controllers\Modules\BlogSidebarController;
use App\Http\Controllers\Modules\BulkUploadsController;
use App\Http\Controllers\Modules\GuruvandanamController;
use App\Http\Controllers\Modules\JsonImportController;
use App\Http\Controllers\Modules\LeadCaptureFormController;
use App\Http\Controllers\Modules\MediaController;
use App\Http\Controllers\Modules\PackageRatingController;
use App\Http\Controllers\Modules\RequestCallbackController;
use App\Http\Controllers\Modules\SubscriberRegistrationController;

Route::prefix('media')->name('media.')->middleware(['auth', '2fa'])->group(function () {
    Route::post('/index', [MediaController::class, 'index'])->name('index');
    Route::post('/store', [MediaController::class, 'store'])->name('store');
    Route::post('/edit', [MediaController::class, 'edit'])->name('edit');
    Route::post('/create', [MediaController::class, 'create'])->name('create');
    Route::put('{media}/update', [MediaController::class, 'update'])->name('update');
    Route::delete('{media}/destroy', [MediaController::class, 'destroy'])->name('destroy');
});

Route::prefix('bulkupload')->name('bulkupload.')->middleware('auth')->group(function () {
    Route::post('store', [BulkUploadsController::class, 'store'])->name('store');
});

Route::prefix('jsonupload')->name('jsonupload.')->middleware('auth')->group(function () {
    Route::post('store', [JsonImportController::class, 'store'])->name('store');
});

Route::prefix('callback')->name('callback.')->group(function () {
    Route::post('otp', [RequestCallbackController::class, 'otp'])->name('otp');
    Route::post('submit', [RequestCallbackController::class, 'store'])->name('store');
});

Route::prefix('package')->name('package.rating.')->group(function () {
    Route::post('{package}/store', [PackageRatingController::class, 'store'])->name('store');
    Route::get('{package}/show', [PackageRatingController::class, 'show'])->name('show');
    Route::get('{rating}/edit', [PackageRatingController::class, 'edit'])->name('edit');
    Route::put('{rating}/update', [PackageRatingController::class, 'update'])->name('update');
});

Route::prefix('subscriber')->name('subscriber.')->group(function () {
    Route::post('otp', [SubscriberRegistrationController::class, 'otp'])->name('otp');
    Route::post('submit', [SubscriberRegistrationController::class, 'store'])->name('store');
});

Route::prefix('leadcapture')->name('leadcapture.')->group(function () {
    Route::get('create', [LeadCaptureFormController::class, 'create'])->name('create');
    Route::post('otp', [LeadCaptureFormController::class, 'otp'])->name('otp');
    Route::post('submit', [LeadCaptureFormController::class, 'store'])->name('store');
});

Route::prefix('guruvandanam')->name('guruvandanam.')->group(function () {
    Route::post('/store', [GuruvandanamController::class, 'store'])->name('store');
    Route::post('/results', [GuruvandanamController::class, 'results'])->name('results');
    Route::get('/index', [GuruvandanamController::class, 'index'])->name('index');
});

Route::prefix('modules')->name('modules.')->group(function () {
    Route::prefix('sidebar')->name('sidebar.')->group(function () {
        Route::get('/', [BlogSidebarController::class, 'index'])->name('index');
    });
});
