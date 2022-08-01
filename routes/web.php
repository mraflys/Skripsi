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


Route::get('/', 'Logincontroller@index')->name('login.auth');
Route::get('/absen/{id}', 'AbsentController@index')->name('absent-index');
Route::post('/webcam-capture', 'AbsentController@webcam_store')->name('webcam.capture');

Route::group(['middleware' => 'auth'], function() {
    Route::get('/home', 'HomeController@index')->name('home');
    Route::get('/absent-index', 'AbsentController@absent_index')->name('absent-face');
    Route::get('/absent/history', 'AbsentController@history_absent')->name('absent-history');
    Route::get('/absent/history/excel', 'AbsentController@history_absent_excel')->name('absent-history-excel');
    Route::get('/absent/history/period', 'AbsentController@history_absent_period')->name('absent-history-period');
    Route::get('/absent/detail/{id}', 'AbsentController@detail_absent')->name('absent.detail-absent');
    Route::get('/absent/periode', 'AbsentController@periode')->name('absent.periode');
    Route::get('/absent/periode/table', 'AbsentController@periode_table')->name('absent.periode.table');
    Route::get('/absent/periode/excel', 'AbsentController@periode_excel')->name('absent.periode.excels');
    Route::post('/webcam-capture/absent', 'AbsentController@absent_store')->name('webcam.capture.absent');
    Route::get('/transactions', 'TransactionController@index')->name('transactions.index');
    Route::get('/transactions/new', 'TransactionController@new')->name('transactions.new');
    Route::get('/transactions/reject/{id}', 'TransactionController@reject')->name('transactions.reject');
    Route::get('/transactions-table', 'TransactionController@datatable')->name('transactions.datatable');
    Route::get('/transactions-history-table', 'TransactionController@datatablehistory')->name('transactions.datatable.history');
    Route::get('/user-list', 'UserController@index')->name('user.list');
    Route::get('/user-table', 'UserController@datatable')->name('user-table');
    Route::get('/user-excel', 'UserController@user_excel')->name('user-excel');
    Route::get('/user-active/{id}', 'UserController@active')->name('user-active');
    Route::get('/user-unactive/{id}', 'UserController@unactive')->name('user-unactive');
});
