<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ItemController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\SalesController;
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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('test', fn() => response('oke masuk'));

Route::post('register', [AuthController::class, 'register']);
Route::post('login', [AuthController::class, 'login']);
Route::post('logout', [AuthController::class, 'logout'])->middleware('auth:sanctum');

Route::get('item/get', [ItemController::class, 'index'])->middleware('auth:sanctum');
Route::post('item/store', [ItemController::class, 'store'])->middleware('auth:sanctum');
Route::post('item/delete', [ItemController::class, 'destroy'])->middleware('auth:sanctum');

Route::get('order/get', [OrderController::class, 'index'])->middleware('auth:sanctum');
Route::post('order/store', [OrderController::class, 'store'])->middleware('auth:sanctum');
Route::post('order/done', [OrderController::class, 'update'])->middleware('auth:sanctum');

Route::get('category/get', [CategoryController::class, 'index'])->middleware('auth:sanctum');
Route::post('category/store', [CategoryController::class, 'store'])->middleware('auth:sanctum');
Route::post('category/delete', [CategoryController::class, 'destroy'])->middleware('auth:sanctum');

Route::get('sales/get', [SalesController::class, 'index'])->middleware('auth:sanctum');

// Route::post('order/done', [OrderDoneController::class, 'store'])->middleware('auth:sanctum');
// Route::get('order/done/get', [OrderDoneController::class, 'index'])->middleware('auth:sanctum');