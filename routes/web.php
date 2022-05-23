<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Route::get('/', 'Logincontroller@index')->name('login.auth');

Route::group(['middleware' => 'auth'], function() {
    Route::get('/absen', 'AbsentController@index')->name('absent-index');
    Route::get('/transactions', 'TransactionController@index')->name('transactions-index');
    Route::get('/transactions-table', 'TransactionController@datatable')->name('transactions.datatable');
});
