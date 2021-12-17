<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\BotMessageController;
use App\Http\Controllers\Api\MessageController;
use App\Http\Controllers\Api\UtilitiesController;
use App\Http\Controllers\Api\Admin\AdminController;


Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('bot_messages',[BotMessageController::class,'index']);
Route::post('messages',[MessageController::class,'send']);
Route::get('messages',[MessageController::class,'get']);


Route::get('admin/customers',[AdminController::class,'customers']);

Route::prefix('utilities')->name('utilities.')->group(function(){
    Route::get('payment-history/{card}', [UtilitiesController::class, 'paymentHistory']);
    Route::get('payment-categories', [UtilitiesController::class, 'paymentCategories']);
});