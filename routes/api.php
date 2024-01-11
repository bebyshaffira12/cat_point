<?php

use App\Http\Controllers\Api\BookingController;
use App\Http\Controllers\Api\InvoiceController;
use App\Http\Controllers\Api\OrderController;
use App\Http\Controllers\Api\PaymentController;
use App\Http\Controllers\Api\TestimoniController;
use App\Http\Controllers\Api\UserController;
use App\Http\Controllers\Api\ServiceController;
use App\Http\Controllers\Api\TreatmentController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

//Route::middleware('auth:api')->group(function () {
    Route::resource('order', OrderController::class);
    Route::resource('booking', BookingController::class);
    Route::resource('invoice', InvoiceController::class);
    Route::resource('testimoni', TestimoniController::class);
    Route::resource('user', UserController::class);
    Route::resource('service', ServiceController::class);
    Route::resource('treatment', TreatmentController::class);
    Route::post('book', [PaymentController::class, 'book']);
    Route::post('generateqr', [PaymentController::class, 'generateqr']);

//});