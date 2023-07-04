<?php

use App\Http\Controllers\PayPalController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', [PayPalController::class, 'paypal'])->name('payment');
Route::get('/cancel', [PayPalController::class, 'cancel'])->name('cancel');
Route::get('/success', [PayPalController::class, 'success'])->name('success');
