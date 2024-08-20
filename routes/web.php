<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\HomeController;
use App\Mail\BasicEmail;



Route::get('/', function () {
    return view('welcome');
});

Route::post('/login', function (Request $request) {
    $credentials = $request->only('email', 'password');

    if (Auth::attempt($credentials)) {
        $user = Auth::user();
        $token = $user->createToken('api-token')->plainTextToken;
        return response()->json(['token' => $token], 200);
    }

    return response()->json(['error' => 'Unauthorized'], 401);
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');


Route::middleware(['auth:sanctum', 'admin'])->group(function () {
    Route::get('/admin/orders', [AdminController::class, 'showOrders'])->name('admin.orders');
    Route::put('/admin/orders/{order}', [AdminController::class, 'updateOrder'])->name('admin.updateOrder');
});


Route::get('/mail', function(){
    Mail::to("fahdnahralharbi@gmail.com")->send(new BasicEmail("Fahad"));
    return "Email was sent" ;
});



Route::middleware(['auth:sanctum'])->group(function () {
    Route::post('/orders', [OrderController::class, 'store'])->name('orders.store');
    Route::get('/user/orders/{id}', [OrderController::class, 'showOrders'])->name('user.orders');
    Route::get('/orders/create', [OrderController::class, 'create'])->name('orders.create');
});


 
;

Route::post('/logout', [LoginController::class, 'logout'])->name('logout');
