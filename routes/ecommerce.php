<?php

use App\Http\Controllers\Ecommerce\BatchController;
use App\Http\Controllers\Ecommerce\CouponsController;
use App\Http\Controllers\Ecommerce\EnrollmentsController;
use App\Http\Controllers\Ecommerce\OrderController;
use App\Http\Controllers\Ecommerce\PackagesController;
use App\Http\Controllers\Ecommerce\PricingController;

Route::prefix('ecommerce')->name('ecommerce.')->middleware(['auth', '2fa'])->group(function () {
    Route::prefix('package')->name('packages.')->group(function () {
        Route::get('/', [PackagesController::class, 'index'])->name('index');
        Route::post('/results', [PackagesController::class, 'results'])->name('results');
        Route::post('/list', [PackagesController::class, 'list'])->name('list');
        Route::get('/create/{slug}', [PackagesController::class, 'create'])->name('create');
        Route::post('/store', [PackagesController::class, 'store'])->name('store');
        Route::get('/{package}/edit/{slug}', [PackagesController::class, 'edit'])->name('edit');
        Route::put('/{package}/update', [PackagesController::class, 'update'])->name('update');
        Route::get('/{package}/show', [PackagesController::class, 'show'])->name('show');
        Route::delete('/{package}/destroy', [PackagesController::class, 'destroy'])->name('destroy');
        Route::post('/{package}/marketing', [PackagesController::class, 'marketing'])->name('marketing');
        Route::put('/{package}/publish', [PackagesController::class, 'publish'])->name('publish');
    });

    Route::prefix('batch')->name('batch.')->group(function () {
        Route::post('/{package}', [BatchController::class, 'index'])->name('index');
        Route::get('/{package}/create', [BatchController::class, 'create'])->name('create');
        Route::get('/{batch}/edit', [BatchController::class, 'edit'])->name('edit');
        Route::post('{package}/store', [BatchController::class, 'store'])->name('store');
        Route::post('{batch}/enrollments', [BatchController::class, 'enrollments'])->name('enrollments');
        Route::put('/{batch}/update', [BatchController::class, 'update'])->name('update');
        Route::delete('/{batch}/destroy', [BatchController::class, 'destroy'])->name('destroy');
        Route::put('/{batch}/update', [BatchController::class, 'update'])->name('update');
    });

    Route::prefix('pricing')->name('pricing.')->group(function () {
        Route::post('/{package}', [PricingController::class, 'index'])->name('index');
        Route::get('/{package}/create', [PricingController::class, 'create'])->name('create');
        Route::get('/{pricing}/edit', [PricingController::class, 'edit'])->name('edit');
        Route::put('/{pricing}/update', [PricingController::class, 'update'])->name('update');
        Route::delete('/{pricing}/destroy', [PricingController::class, 'destroy'])->name('destroy');
        Route::post('{package}/store', [PricingController::class, 'store'])->name('store');
    });

    Route::prefix('coupons')->name('coupons.')->group(function () {
        Route::get('/', [CouponsController::class, 'index'])->name('index');
        Route::post('/results', [CouponsController::class, 'results'])->name('results');
        Route::get('/create', [CouponsController::class, 'create'])->name('create');
        Route::post('/store', [CouponsController::class, 'store'])->name('store');
        Route::get('{coupon}/edit', [CouponsController::class, 'edit'])->name('edit');
        Route::put('{coupon}/update', [CouponsController::class, 'update'])->name('update');
        Route::post('{coupon}/claims', [CouponsController::class, 'claims'])->name('claims');
        Route::delete('{coupon}/destroy', [CouponsController::class, 'destroy'])->name('destroy');
    });

    Route::prefix('orders')->name('orders.')->group(function () {
        Route::get('/', [OrderController::class, 'index'])->name('index');
        Route::post('/results', [OrderController::class, 'results'])->name('results');
        Route::get('/create', [OrderController::class, 'create'])->name('create');
        Route::get('/{order}/edit', [OrderController::class, 'edit'])->name('edit');
        Route::post('/store', [OrderController::class, 'store'])->name('store');
        Route::put('{order}/update', [OrderController::class, 'update'])->name('update');
        Route::post('notes/{order}/add', [OrderController::class, 'add_note'])->name('notes.add');
        Route::get('notes/{order}/index', [OrderController::class, 'get_notes'])->name('notes.index');
        Route::get('{package}/getpricings', [OrderController::class, 'getpricings'])->name('getpricings');
    });
});

Route::prefix('ecommerce')->name('ecommerce.')->group(function () {
    Route::prefix('pricing')->name('pricing.')->group(function () {
        Route::get('/{pricing}/show', [PricingController::class, 'show'])->name('show');
    });

    Route::prefix('enrollments')->name('enrollments.')->group(function () {
        Route::get('/', [EnrollmentsController::class, 'index'])->name('index');
        Route::post('/results', [EnrollmentsController::class, 'results'])->name('results');
    });
});
