<?php

use App\Http\Controllers\Api\TelegramAuthController;
use App\Http\Controllers\TelegramHandlerController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::prefix('telegram')->name('api.telegram.')->group(function () {
    Route::post('handler', [TelegramHandlerController::class, 'handle']);
    Route::post('register', [TelegramAuthController::class, 'register'])->name('register');
});
