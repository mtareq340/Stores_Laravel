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



// Route::group(['middleware' => ['auth', 'admin']], function () {
//     Route::get('/', 'Admin\DashboardController@index')->name('admin.dashboard');
// });

Auth::routes();


    Route::group(['prefix'=> 'admin','namespace'=>'Admin','middleware' => ['auth','admin']], function(){

        Route::get('/', 'DashboardController@index')->name('admin.dashboard');

 

      ############################### Begin main_categories Route ##################################

      Route::group(['prefix'=> 'main_categories'], function(){
        Route::get('/','MainCategoryController@index')->name('admin.maincategories');
        Route::get('create','MainCategoryController@create')->name('admin.maincategories.create');
        Route::post('store','MainCategoryController@store')->name('admin.maincategories.store');
        Route::get('edit/{id}','MainCategoryController@edit')->name('admin.maincategories.edit');
        Route::post('update/{id}','MainCategoryController@update')->name('admin.maincategories.update');
        Route::delete('delete/{id}','MainCategoryController@destroy')->name('admin.maincategories.delete');
    });

    ############################### End main_categories Route ##################################

     ############################### Begin technicals Route ##################################

     Route::group(['prefix'=> 'technicals'], function(){
        Route::get('/','TechnicalController@index')->name('admin.technicals');
        Route::get('create','TechnicalController@create')->name('admin.technicals.create');
        Route::post('store','TechnicalController@store')->name('admin.technicals.store');
        Route::get('edit/{id}','TechnicalController@edit')->name('admin.technicals.edit');
        Route::post('update/{id}','TechnicalController@update')->name('admin.technicals.update');
        Route::delete('delete/{id}','TechnicalController@destroy')->name('admin.technicals.delete');
        Route::post('fetch_data','TechnicalController@fetch_data')->name('admin.technicals.fetch_data');

    });

    ############################### End technicals Route ##################################

     ############################### Begin stores Route ##################################

     Route::group(['prefix'=> 'stores'], function(){
        Route::get('/','StoreController@index')->name('admin.stores');
        Route::get('create','StoreController@create')->name('admin.stores.create');
        Route::post('store','StoreController@store')->name('admin.stores.store');
        Route::get('edit/{id}','StoreController@edit')->name('admin.stores.edit');
        Route::post('update/{id}','StoreController@update')->name('admin.stores.update');
        Route::delete('delete/{id}','StoreController@destroy')->name('admin.stores.delete');
        Route::get('supply/{id}','StoreController@supply')->name('admin.stores.supply');
        Route::get('{id}/stock','StoreController@stock')->name('admin.stores.stock');
        Route::get('{id}/orders','StoreController@orders')->name('admin.stores.orders');

    });

    ############################### End stores Route ##################################

     ############################### Begin categories Route ##################################
     Route::group(['prefix'=> 'categories'], function(){
        Route::get('/','CategoryController@index')->name('admin.categories');
        Route::get('create','CategoryController@create')->name('admin.categories.create');
        Route::post('store','CategoryController@store')->name('admin.categories.store');
        Route::get('edit/{id}','CategoryController@edit')->name('admin.categories.edit');
        Route::post('update/{id}','CategoryController@update')->name('admin.categories.update');
        Route::delete('delete/{id}','CategoryController@destroy')->name('admin.categories.delete');
    });
    ############################### End categories Route ##################################
    ############################### Begin products Route ##################################
    Route::group(['prefix'=> 'products'], function(){
        Route::get('/','ProductController@index')->name('admin.products');
        Route::get('create','ProductController@create')->name('admin.products.create');
        Route::post('store','ProductController@store')->name('admin.products.store');
        Route::get('edit/{id}','ProductController@edit')->name('admin.products.edit');
        Route::post('update/{id}','ProductController@update')->name('admin.products.update');
        Route::delete('delete/{id}','ProductController@destroy')->name('admin.products.delete');
    });
    ############################### End categories Route ##################################
     ############################### Begin clients Route ##################################
     Route::group(['prefix'=> 'clients'], function(){
        Route::get('/','ClientController@index')->name('admin.clients');
        Route::get('create','ClientController@create')->name('admin.clients.create');
        Route::post('store','ClientController@store')->name('admin.clients.store');
        Route::get('edit/{id}','ClientController@edit')->name('admin.clients.edit');
        Route::post('update/{id}','ClientController@update')->name('admin.clients.update');
        Route::delete('delete/{id}','ClientController@destroy')->name('admin.clients.delete');
    });
    ############################### End clients Route ##################################
      ############################### Begin admins Route ##################################
      Route::group(['prefix'=> 'admins'], function(){
        Route::get('/','AdminController@index')->name('admin.admins');
        Route::get('create','AdminController@create')->name('admin.admins.create');
        Route::post('store','AdminController@store')->name('admin.admins.store');
        Route::get('edit/{id}','AdminController@edit')->name('admin.admins.edit');
        Route::post('update/{id}','AdminController@update')->name('admin.admins.update');
        Route::delete('delete/{id}','AdminController@destroy')->name('admin.admins.delete');
    });
    ############################### End admins Route ##################################
      ############################### Begin cacheirs Route ##################################
      Route::group(['prefix'=> 'cacheirs'], function(){
        Route::get('/','CacheirController@index')->name('admin.cacheirs');
        Route::get('create','CacheirController@create')->name('admin.cacheirs.create');
        Route::post('store','CacheirController@store')->name('admin.cacheirs.store');
        Route::get('edit/{id}','CacheirController@edit')->name('admin.cacheirs.edit');
        Route::post('update/{id}','CacheirController@update')->name('admin.cacheirs.update');
        Route::delete('delete/{id}','CacheirController@destroy')->name('admin.cacheirs.delete');
    });
    ############################### End cacheirs Route ##################################
         ############################### Begin orders Route ##################################
            Route::group(['prefix'=> 'orders'], function(){
            Route::get('/','OrderController@index')->name('admin.orders');
            Route::get('discount','OrderController@discount')->name('admin.orders.discount');
            Route::get('misorders','OrderController@misOrders')->name('admin.orders.misorders');
            Route::post('discountconfirm','OrderController@discountConfirm')->name('admin.orders.discountconfirm');
            Route::delete('discount/delete/{id}','OrderController@deleteDiscount')->name('admin.orders.discount.delete');
            Route::get('create','OrderController@create')->name('admin.orders.create');
            Route::post('store','OrderController@store')->name('admin.orders.store');
            Route::get('edit/{id}','OrderController@edit')->name('admin.orders.edit');
            Route::post('update/{id}','OrderController@update')->name('admin.orders.update');
            Route::delete('delete/{id}','OrderController@destroy')->name('admin.orders.delete');
        });
        ############################### End orders Route ##################################
           ############################### Begin permissions Route ##################################
           Route::group(['prefix'=> 'permissions'], function(){
            Route::get('/','PermissionController@index')->name('admin.permissions');
            Route::get('create','PermissionController@create')->name('admin.permissions.create');
            Route::post('store','PermissionController@store')->name('admin.permissions.store');
            Route::get('edit/{id}','PermissionController@edit')->name('admin.permissions.edit');
            Route::post('update/{id}','PermissionController@update')->name('admin.permissions.update');
            Route::get('delete/{id}','PermissionController@destroy')->name('admin.permissions.delete');
        });
        ############################### End permissions Route ##################################
          ############################### Begin roles Route ##################################
          Route::group(['prefix'=> 'roles'], function(){
            Route::get('/','RoleController@index')->name('admin.roles');
            Route::get('create','RoleController@create')->name('admin.roles.create');
            Route::post('store','RoleController@store')->name('admin.roles.store');
            Route::get('edit/{id}','RoleController@edit')->name('admin.roles.edit');
            Route::post('update/{id}','RoleController@update')->name('admin.roles.update');
            Route::delete('delete/{id}','RoleController@destroy')->name('admin.roles.delete');
        });
        ############################### End roles Route ##################################
         ############################### Begin carcolors Route ##################################
         Route::group(['prefix'=> 'carcolors'], function(){
            Route::get('/','CarColorController@index')->name('admin.carcolors');
            Route::get('create','CarColorController@create')->name('admin.carcolors.create');
            Route::post('store','CarColorController@store')->name('admin.carcolors.store');
            Route::get('edit/{id}','CarColorController@edit')->name('admin.carcolors.edit');
            Route::post('update/{id}','CarColorController@update')->name('admin.carcolors.update');
            Route::delete('delete/{id}','CarColorController@destroy')->name('admin.carcolors.delete');
        });
        ############################### End carcolors Route ##################################
        ############################### Begin carsorts Route ##################################
        Route::group(['prefix'=> 'carsorts'], function(){
        Route::get('/','CarSortController@index')->name('admin.carsorts');
        Route::get('create','CarSortController@create')->name('admin.carsorts.create');
        Route::post('store','CarSortController@store')->name('admin.carsorts.store');
        Route::get('edit/{id}','CarSortController@edit')->name('admin.carsorts.edit');
        Route::post('update/{id}','CarSortController@update')->name('admin.carsorts.update');
        Route::delete('delete/{id}','CarSortController@destroy')->name('admin.carsorts.delete');
        });
                ############################### End carsorts Route ##################################
         ############################### Begin countries Route ##################################
         Route::group(['prefix'=> 'countries'], function(){
            Route::get('/','CountryController@index')->name('admin.countries');
            Route::get('create','CountryController@create')->name('admin.countries.create');
            Route::post('store','CountryController@store')->name('admin.countries.store');
            Route::get('edit/{id}','CountryController@edit')->name('admin.countries.edit');
            Route::post('update/{id}','CountryController@update')->name('admin.countries.update');
            Route::delete('delete/{id}','CountryController@destroy')->name('admin.countries.delete');
        });
        ############################### End countries Route ##################################
           ############################### Begin suppliers Route ##################################
           Route::group(['prefix'=> 'suppliers'], function(){
            Route::get('/','SupplierController@index')->name('admin.suppliers');
            Route::get('create','SupplierController@create')->name('admin.suppliers.create');
            Route::post('store','SupplierController@store')->name('admin.suppliers.store');
            Route::get('edit/{id}','SupplierController@edit')->name('admin.suppliers.edit');
            Route::post('update/{id}','SupplierController@update')->name('admin.suppliers.update');
            Route::delete('delete/{id}','SupplierController@destroy')->name('admin.suppliers.delete');
            Route::get('{id}/orders','SupplierController@orders')->name('admin.suppliers.orders');

        });
        ############################### End suppliers Route ##################################
             ############################### Begin mainproducts Route ##################################
             Route::group(['prefix'=> 'mainproducts'], function(){
                Route::get('/','MainproductController@index')->name('admin.mainproducts');
                Route::get('create','MainproductController@create')->name('admin.mainproducts.create');
                Route::post('store','MainproductController@store')->name('admin.mainproducts.store');
                Route::get('edit/{id}','MainproductController@edit')->name('admin.mainproducts.edit');
                Route::post('update/{id}','MainproductController@update')->name('admin.mainproducts.update');
                Route::delete('delete/{id}','MainproductController@destroy')->name('admin.mainproducts.delete');
            });
            ############################### End mainproducts Route ##################################
            ############################### Begin supplierorders Route ##################################
            Route::group(['prefix'=> 'supplierorders'], function(){
                Route::get('/','SupplierorderController@index')->name('admin.supplierorders');
                Route::get('create/{id}','SupplierorderController@create')->name('admin.supplierorders.create');
                Route::post('store','SupplierorderController@store')->name('admin.supplierorders.store');
                Route::get('edit/{id}','SupplierorderController@edit')->name('admin.supplierorders.edit');
                Route::post('update','SupplierorderController@update')->name('admin.supplierorders.update');
                Route::delete('delete/{id}','SupplierorderController@destroy')->name('admin.supplierorders.delete');
            });
            ############################### End suppliers Route ##################################
            ############################### Begin storesorders Route ##################################
            Route::group(['prefix'=> 'storeorders'], function(){
                Route::get('/','StoreorderController@index')->name('admin.storeorders');
                Route::get('create/{id}','StoreorderController@create')->name('admin.storeorders.create');
                Route::post('store','StoreorderController@store')->name('admin.storeorders.store');
                Route::get('edit/{id}','StoreorderController@edit')->name('admin.storeorders.edit');
                Route::post('update','StoreorderController@update')->name('admin.storeorders.update');
                Route::delete('delete/{id}','StoreorderController@destroy')->name('admin.storeorders.delete');
            });
            ############################### End suppliers Route ##################################


});

// Route::post('update/{id}','SupplierorderController@update')->name('admin.supplierorders.update');



