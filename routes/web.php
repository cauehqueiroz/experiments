<?php

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
Route::group(['middleware' => ['auth'], 'namespace' => 'Admin', 'prefix' => 'admin'], function(){

  Route::post('historic', 'BalanceController@historic')->name('historic.search');
  Route::get('historic', 'BalanceController@historic')->name('admin.historic');

  Route::get('transfer', 'BalanceController@transfer')->name('admin.transfer');
  Route::post('transfer', 'BalanceController@transferStore')->name('transfer.store');
  Route::post('confirm-transfer', 'BalanceController@confirmTransfer')->name('transfer.confirm');

  Route::post('deposit', 'BalanceController@depositStore')->name('deposit.store');
  Route::get('deposit', 'BalanceController@deposit')->name('admin.deposit');

  Route::get('withdraw', 'BalanceController@withdraw')->name('admin.withdraw');
  Route::post('withdraw', 'BalanceController@withdrawStore')->name('withdraw.store');

  Route::get('balance', 'BalanceController@index')->name('admin.balance');

  Route::get('/', 'AdminController@index')->name('admin.home');
});

Route::post('/profile', 'Admin\UserController@profileUpdate')->name('profile.update')->middleware('auth');
Route::get('/profile', 'Admin\UserController@profile')->name('profile')->middleware('auth');
Route::get('/', 'Site\SiteController@index')->name('home');

Auth::routes();
