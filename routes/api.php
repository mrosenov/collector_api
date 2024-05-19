<?php

use App\Http\Controllers\v1\AuthController;
use App\Http\Controllers\v1\CustomerController;
use App\Http\Controllers\v1\InvoiceController;
use App\Http\Controllers\v1\ProductController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::post('/v1/register', [AuthController::class, 'register']);
Route::post('/v1/login', [AuthController::class, 'login']);

Route::group(['prefix' => 'v1', 'namespace' => 'App\Http\Controllers\v1', 'middleware' => 'auth:sanctum'], function () {
    Route::apiResource('customers', CustomerController::class);
    Route::apiResource('invoices', InvoiceController::class);
    Route::apiResource('products', ProductController::class);

    Route::post('logout', [AuthController::class, 'logout']);
});
