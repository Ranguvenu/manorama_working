<?php

use App\Http\Controllers\WebhooksController;

Route::prefix('webhooks')->name('webhooks.')->group(function () {
    Route::post('sinch', [WebhooksController::class, 'sinch'])->name('sinch');
    Route::post('smscountry', [WebhooksController::class, 'smscountry'])->name('smscountry');
    Route::post('raalink/{caller:call_id}', [WebhooksController::class, 'capture_raalink_response'])->name('raalink');
});
