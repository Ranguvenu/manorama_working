<?php

use App\Http\Controllers\Blog\ArticleController;
use App\Http\Controllers\Content\StudyMaterialsController;
use App\Http\Controllers\Content\WebinarsController;
use App\Http\Controllers\Ecommerce\CheckoutController;
use App\Http\Controllers\Ecommerce\PaymentGatewayController;
use App\Http\Controllers\Website\FrontendPagesController;

Route::prefix('checkout')->name('checkout.')->middleware(['auth', '2fa'])->group(function () {
    Route::get('/', [CheckoutController::class, 'index'])->name('index');
    Route::post('/{variation}/summary', [CheckoutController::class, 'summary'])->name('summary');
    Route::get('/profile', [CheckoutController::class, 'profile'])->name('profile');
    Route::get('/{package}/order/{order:order_key}/{status}', [CheckoutController::class, 'complete'])->name('complete');
    Route::get('/{package}/cancelled/{order:order_key}', [CheckoutController::class, 'cancelled'])->name('cancelled');
    Route::prefix('coupon')->name('coupon.')->group(function () {
        Route::post('/{package}/apply', [CheckoutController::class, 'apply_coupon'])->name('apply');
    });
});
Route::prefix('payment')->name('payment.')->group(function () {
    Route::post('/{variation}/order', [PaymentGatewayController::class, 'order'])->name('order');
    Route::get('/process', [PaymentGatewayController::class, 'process'])->name('process');
    Route::get('/cancelled', [PaymentGatewayController::class, 'cancel'])->name('cancel');
    Route::post('/verify', [PaymentGatewayController::class, 'verify'])->name('verify');

    // Route::get('/razorpay', function () {
    //     return view('paymentgateway.razorpay');
    // });
});

Route::prefix('ecommerce')->middleware('2fa')->name('ecommerce.')->group(function () {
    Route::prefix('lms')->name('lms.')->group(function () {
        Route::get('{type}/{course:mdl_id}', [FrontendPagesController::class, 'lms_package'])->name('package');
    });
});
Route::prefix('blogs')->middleware('2fa')->group(function () {
    Route::prefix('{category:slug}')->name('blog.')->group(function () {
        Route::get('{article:slug}', [ArticleController::class, 'show'])->name('show');
    });
});
Route::prefix('study-material')->middleware('2fa')->name('studymaterial.')->group(function () {
    Route::get('{material:slug}', [StudyMaterialsController::class, 'show'])->name('show');
});
Route::prefix('webinar')->middleware('2fa')->name('webinar.')->group(function () {
    Route::get('{webinar:slug}', [WebinarsController::class, 'show'])->name('show');
});

Route::prefix('package')->middleware('2fa')->group(function () {
    Route::get('{type}/{page:slug}', [FrontendPagesController::class, 'package'])->name('frontend.package');
});
Route::get('search', [FrontendPagesController::class, 'search'])->name('search');
Route::get('{page:slug}', [FrontendPagesController::class, 'index'])->middleware('2fa')->name('frontend.index');
