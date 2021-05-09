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


Route::group(['middleware' => ['auth', 'store'], 'prefix' => 'store'], function () {
    Route::get('/', 'HomeController@index')->name('store');
});

// admin protected routes

 ############################### Begin orders Route ##################################

 Route::group(['prefix'=> '/store/orders','middleware' => ['auth', 'store']], function(){
    Route::get('/','OrderController@index')->name('store.orders');
    Route::get('create','OrderController@create')->name('store.orders.create');
    Route::post('store','OrderController@store')->name('store.orders.store');
    Route::get('edit/{id}','OrderController@edit')->name('store.orders.edit');
    Route::post('update/{id}','OrderController@update')->name('store.orders.update');
    Route::get('delete/{id}','OrderController@destroy')->name('store.orders.delete');

    Route::get('print','OrderController@printOrder')->name('store.orders.print');

});
 ############################### end orders Route ##################################


//  Route::get('/home', 'HomeController@index')->name('home');



