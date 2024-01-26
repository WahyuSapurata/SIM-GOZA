<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::group(['namespace' => 'App\Http\Controllers'], function () {

    Route::get('/', 'Dashboard@index')->name('home.index');

    Route::group(['prefix' => 'login', 'middleware' => ['guest'], 'as' => 'login.'], function () {
        Route::get('/login-akun', 'Auth@show')->name('login-akun');
        Route::post('/login-proses', 'Auth@login_proses')->name('login-proses');
    });

    Route::group(['prefix' => 'admin', 'middleware' => ['auth'], 'as' => 'admin.'], function () {
        Route::get('/dashboard-admin', 'Dashboard@dashboard')->name('dashboard-admin');

        Route::get('/datauser', 'DataUser@index')->name('datauser');
        Route::get('/get-datauser', 'DataUser@get')->name('get-datauser');
        Route::post('/add-datauser', 'DataUser@store')->name('add-datauser');
        Route::get('/show-datauser/{params}', 'DataUser@show')->name('show-datauser');
        Route::post('/update-datauser/{params}', 'DataUser@update')->name('update-datauser');
        Route::delete('/delete-datauser/{params}', 'DataUser@delete')->name('delete-datauser');

        Route::get('/penjualan', 'PenjualanController@index')->name('penjualan');
        Route::get('/get-penjualan', 'PenjualanController@get')->name('get-penjualan');
        Route::post('/add-penjualan', 'PenjualanController@store')->name('add-penjualan');
        Route::get('/show-penjualan/{params}', 'PenjualanController@show')->name('show-penjualan');
        Route::post('/update-penjualan/{params}', 'PenjualanController@update')->name('update-penjualan');
        Route::delete('/delete-penjualan/{params}', 'PenjualanController@delete')->name('delete-penjualan');

        Route::get('/pengeluaran', 'BiayaController@index')->name('pengeluaran');
        Route::get('/get-pengeluaran', 'BiayaController@get')->name('get-pengeluaran');
        Route::post('/add-pengeluaran', 'BiayaController@store')->name('add-pengeluaran');
        Route::get('/show-pengeluaran/{params}', 'BiayaController@show')->name('show-pengeluaran');
        Route::post('/update-pengeluaran/{params}', 'BiayaController@update')->name('update-pengeluaran');
        Route::delete('/delete-pengeluaran/{params}', 'BiayaController@delete')->name('delete-pengeluaran');

        Route::get('/ubahpassword', 'UbahPassword@index')->name('ubahpassword');
        Route::post('/update-password/{params}', 'UbahPassword@update')->name('update-password');
    });

    Route::get('/logout', 'Auth@logout')->name('logout');
});
