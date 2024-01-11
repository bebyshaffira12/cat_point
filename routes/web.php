<?php

use App\Http\Controllers\Admin\AdminController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

 Route::get('/',[AdminController::class,'index']);
 Route::get('/admin',[AdminController::class,'index']);
 Route::get('/jenispaket',[AdminController::class,'jenispaket']);
 Route::get('/pesanan',[AdminController::class,'pesanan']);
 Route::get('/invoice',[AdminController::class,'invoice']);
 Route::get('/testimoni',[AdminController::class,'testimoni']);