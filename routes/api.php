<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\BookingController;

Route::middleware('auth:sanctum')->group(function () {
    Route::apiResource('bookings', BookingController::class);
}); 