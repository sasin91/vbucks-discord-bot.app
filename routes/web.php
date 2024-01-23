<?php

use App\Http\Controllers\CheckoutCancelController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\CheckoutSuccessController;
use App\Http\Controllers\DiscordInteractionController;
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

Route::post('/discord', DiscordInteractionController::class);

Route::view('/', 'welcome');

Route::post('/checkout', CheckoutController::class)->name('checkout');
Route::get('/checkout/success', CheckoutSuccessController::class)->name('checkout.success');
Route::get('/checkout/cancel', CheckoutCancelController::class)->name('checkout.cancel');

Route::view('dashboard', 'dashboard')
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::view('profile', 'profile')
    ->middleware(['auth'])
    ->name('profile');

require __DIR__.'/auth.php';
