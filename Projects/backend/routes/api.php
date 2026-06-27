<?php

use App\Http\Controllers\VoucherController;
use App\Http\Controllers\FlightController;

Route::post('/check', [FlightController::class, 'check']);
Route::post('/generate', [VoucherController::class, 'store']);
Route::get('/passengers', [VoucherController::class, 'index']);