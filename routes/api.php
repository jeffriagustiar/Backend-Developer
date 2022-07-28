<?php

use App\Http\Controllers\AController;
use App\Http\Controllers\ProductsController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('register', [AController::class, 'regis']);
Route::post('login', [AController::class, 'login']);
Route::post('logout', [AController::class, 'logout']);

Route::middleware('auth:sanctum')->group(function () {
    Route::post('product/add',[ProductsController::class, 'add']);
    Route::post('product/edit',[ProductsController::class, 'edit']);
    Route::delete('product/delete',[ProductsController::class, 'delete']);
});