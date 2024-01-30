<?php

use App\Http\Controllers\Auth;
use App\Http\Controllers\BiayaController;
use App\Http\Controllers\PenjualanController;
use App\Http\Controllers\UbahPassword;
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

Route::middleware('cors')->group(function () {
    Route::post('/api-login', [Auth::class, 'do_login']);
    Route::middleware('auth:sanctum')->group(function () {
        Route::post('/do-ubahpassword/{params}', [UbahPassword::class, 'update']);

        Route::get('/api-getuser', [Auth::class, 'get_user']);

        Route::post('/api-penjualan-add', [PenjualanController::class, 'store']);
        Route::post('/api-pengeluaran-add', [BiayaController::class, 'store']);

        Route::get('/api-logout', [Auth::class, 'revoke']);
    });
});
