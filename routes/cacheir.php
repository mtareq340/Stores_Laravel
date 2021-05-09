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

Route::group(['middleware' => ['auth','cacheir'], 'prefix' => 'cacheir', 'namespace' => 'Cacheir'], function () {
    Route::get('/', 'DashboardController@index')->name('cacheir');
    Route::get('/misorders', 'OrderController@misOrders')->name('cacheir.misorders');
    Route::get('/stock', 'StockController@index')->name('cacheir.stock');
    Route::get('/reports', 'ReportController@reports')->name('cacheir.reports');
    Route::get('/reports/products', 'ReportController@products')->name('cacheir.reports.products');
    Route::get('/reports/excel', 'ReportController@excel')->name('cacheir.reports.excel');
    Route::get('/productsprice', 'ProductPriceController@index')->name('cacheir.productsprice.index');
    Route::get('productsprice/edit','ProductPriceController@edit')->name('cacheir.productsprice.edit');
    Route::post('productsprice/update','ProductPriceController@update')->name('cacheir.productsprice.update');
    Route::get('/orders/{order}/products', 'OrderController@products')->name('cacheir.orders.products');
    Route::post('/orders/{order}/priceconfirm', 'OrderController@priceConfirm')->name('cacheir.orders.priceconfirm');
    Route::get('/orders/{order}/misproducts', 'OrderController@misProducts')->name('cacheir.orders.misproducts');
    Route::delete('orders/delete/{order}','OrderController@destroy')->name('cacheir.orders.destroy');

    Route::post('shifts/create','ShiftController@create_shift')->name('cacheir.shifts.create');
    Route::post('shifts/end','ShiftController@end_shift')->name('cacheir.shifts.end');

    // Route::get('assignorder','OrderController@assignOrder')->name('cacheir.assignorder');
    // Route::get('assignorder', 'AssignOrderController@index')->name('cacheir.assignorder');
    // Route::get('/assignorder/action', 'AssignOrderController@action')->name('cacheir.assignorder.action');
    

    Route::get('order/{id}/clients', 'ClientController@index')->name('cacheir.order.clients');
    Route::get('order/{order_id}/clients/{client_id}', 'ClientController@confirmOrder')->name('cacheir.order.clients.confirm');
    Route::post('clients/store', 'ClientController@store')->name('cacheir.clients.store');
    Route::post('clients/storecar', 'ClientController@storeCar')->name('cacheir.clients.storecar');
    Route::get('clients/{id}/edit/','ClientController@edit');
    Route::delete('clients/{id}/delete/','ClientController@destroy');
    Route::delete('order/{order_id}/clients/{id}/delete_client_car/','ClientController@delete_client_car');

    Route::get('order/{order_id}/clients/{id}/confirm/','ClientController@confirm');
    Route::post('order/{order_id}/discount/','ClientController@discount')->name('cacheir.order.discount');
    Route::post('order/clients/storeconfirm/','ClientController@storeConfirm')->name('cacheir.order.clients.storeconfirm');

    Route::get('reports/shifts', 'ReportController@shiftsReport')->name('cacheir.reports.shifts');

});









