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
Route::group(['middleware'=>['auth'],'namespace','Admin','prefix'=>"admin"],function(){

  //Route::get('/deposit', 'Admin\BalanceController@deposit')->name('admin.deposit');
  Route::get('/balance', 'Admin\BalanceController@index')->name('admin.balance');

  Route::get('/', 'Admin\AdminController@index')->name('admin.home');
});

Route::get('/', 'Site\SiteController@index')->name('home');

Auth::routes();
