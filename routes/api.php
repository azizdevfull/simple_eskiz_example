<?php

use App\Http\Controllers\SendSmsController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');


Route::get('/sendSms', [SendSmsController::class, 'sendSms']);
