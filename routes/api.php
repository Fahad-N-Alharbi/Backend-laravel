<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
//use App\Http\Controllers\LoginController;

use App\Http\Controllers\ApiController;
use App\Http\Controllers\OrderController;


Route::post('register', [ApiController::class,'register']);

Route::post('login', [ApiController::class,'login']);

//Route::get('orders/{id}', [ApiController::class,'index']);

Route::middleware(['auth:api'])->group(function (){

    Route::get('order', [OrderController::class,'index']);
    Route::post('create-order', [OrderController::class,'storeOrderApi']);
});


