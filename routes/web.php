<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\BotMessageController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\UtilitiesController;


Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Auth::routes();

Route::get('/temp', [App\Http\Controllers\HomeController::class, 'temp'])->name('temp');
Route::prefix('utilities')->name('utilities.')->group(function(){
    Route::get('payment-history', [UtilitiesController::class, 'paymentHistory'])->name('payment_history');
});

Route::get('/admin', [AdminController::class, 'index'])->name('admin');
Route::get('/admin/bot-messages/create', [AdminController::class, 'botMessagesCreate'])->name('bot_messages.create');
Route::post('/admin/bot-messages', [AdminController::class, 'botMessagesStore'])->name('bot_messages.store');