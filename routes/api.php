<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\OrderDetailController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\OptionController;

Route::apiResource('customers', CustomerController::class);
Route::apiResource('orders', OrderController::class);
Route::apiResource('order-details', OrderDetailController::class);
Route::apiResource('products', ProductController::class);
Route::apiResource('categories', CategoryController::class);
Route::apiResource('options', OptionController::class);
