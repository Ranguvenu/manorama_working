<?php

use App\Http\Controllers\Ecommerce\Api\PackagesController;
use App\Http\Controllers\MasterData\Api\HierarchyController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::prefix('v1')->name('v1.')->group(function () {
    Route::prefix('hierarchy')->name('hierarchy.')->group(function () {
        Route::post('/', [HierarchyController::class, 'index'])->name('index');
    });
    Route::prefix('packages')->name('packages.')->group(function () {
        Route::post('/', [PackagesController::class, 'index'])->name('index');
    });
});
