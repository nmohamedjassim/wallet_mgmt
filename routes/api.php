<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CustomerController;
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

Route::get('customers', [CustomerController::class, 'index']);
Route::post('customers', [CustomerController::class, 'store']);
Route::get('customers/{id}', [CustomerController::class, 'show']);
Route::get('customers/{id}/edit', [CustomerController::class, 'edit']);
Route::put('customers/{id}/edit', [CustomerController::class, 'update']);
Route::delete('customers/{id}/delete', [CustomerController::class, 'delete']);
Route::put('customers/{id}/restore', [CustomerController::class, 'restore']);
Route::put('customers/{id}/add-balance', [CustomerController::class, 'addBalance']);
Route::put('customers/{id}/deduct-balance', [CustomerController::class, 'deductBalance']);