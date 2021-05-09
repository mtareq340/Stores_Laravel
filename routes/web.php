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

// Route::group(['namespace'=>'Auth'],function(){
//     Route::get('login','LoginController@getLogin')->name('get.login');
//     Route::post('login','LoginController@login')->name('login');
//     Route::get('/logout', 'LoginController@logout');

// });
// Route::post('/login',['uses' => 'LoginController@login','as' => 'login']);

// Route::post('/login','LoginController@login')->name('login.custom');

Route::get('/', function () {
    return redirect(route('login'));
 });

// Route::group(['middleware' => ['auth', 'store'], 'prefix' => 'user'], function () {
//     Route::get('/', 'HomeController@index')->name('user');
// });

// admin protected routes






