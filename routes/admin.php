<?php

Route::group(['prefix'  =>  'admin'], function () {

    Route::get('login', 'Admin\LoginController@showLoginForm')->name('admin.login');
    Route::post('login', 'Admin\LoginController@login')->name('admin.login.post');
    Route::get('logout', 'Admin\LoginController@logout')->name('admin.logout');

    Route::group(['middleware' => ['auth:admin']], function () {

        Route::get('/', 'Admin\AdminController@showdashboard')->name('admin.dashboard');

        Route::get('/feedback', 'Admin\AdminController@getFeedback')->name('admin.feedback');
        Route::get('/feedback/{feedback}', 'Admin\AdminController@showFeedback')->name('admin.feedback.show');
        Route::get('/feedback/{feedback}/review', 'Admin\AdminController@markAsReviewed')->name('admin.feedback.reviewed');
        
        Route::get('/notifications', 'Admin\AdminController@showNotification')->name('admin.notification');
        Route::post('/mark-as-read', 'Admin\AdminController@markNotification')->name('markNotification');

        Route::get('/vueorders', 'Admin\AdminController@vueTable');

        Route::resource('/roles','Admin\RoleController');
        Route::resource('/users','Admin\UserController');
        Route::get('/useroles','Admin\UserController@index')->name('admin.usersrole.index');

        Route::get('/customers','Admin\AdminController@viewCustomers')->name('customers.index');
        Route::get('/customers/{id}','Admin\AdminController@showCustomers')->name('customers.show');

        Route::get('/settings', 'Admin\SettingController@index')->name('admin.settings');
        Route::post('/settings', 'Admin\SettingController@update')->name('admin.settings.update');
        Route::post('/settings/user', 'Admin\SettingController@updateUser')->name('admin.settings.user.update');

        Route::group(['prefix'  =>   'categories'], function() {

            Route::get('/', 'Admin\CategoryController@index')->name('admin.categories.index');
            Route::get('/create', 'Admin\CategoryController@create')->name('admin.categories.create');
            Route::post('/store', 'Admin\CategoryController@store')->name('admin.categories.store');
            Route::get('/{id}/edit', 'Admin\CategoryController@edit')->name('admin.categories.edit');
            Route::post('/update', 'Admin\CategoryController@update')->name('admin.categories.update');
            Route::get('/{id}/delete', 'Admin\CategoryController@delete')->name('admin.categories.delete');

        });

        Route::group(['prefix'  =>   'attributes'], function() {

            Route::get('/', 'Admin\AttributeController@index')->name('admin.attributes.index');
            Route::get('/create', 'Admin\AttributeController@create')->name('admin.attributes.create');
            Route::post('/store', 'Admin\AttributeController@store')->name('admin.attributes.store');
            Route::get('/{id}/edit', 'Admin\AttributeController@edit')->name('admin.attributes.edit');
            Route::post('/update', 'Admin\AttributeController@update')->name('admin.attributes.update');
            Route::get('/{id}/delete', 'Admin\AttributeController@delete')->name('admin.attributes.delete');

            Route::post('/get-values', 'Admin\AttributeValueController@getValues');
            Route::post('/add-values', 'Admin\AttributeValueController@addValues');
            Route::post('/update-values', 'Admin\AttributeValueController@updateValues');
            Route::post('/delete-values', 'Admin\AttributeValueController@deleteValues');
        });

        Route::group(['prefix' => 'products'], function () {

           Route::get('/', 'Admin\ProductController@index')->name('admin.products.index');
           Route::get('/create', 'Admin\ProductController@create')->name('admin.products.create');
           Route::post('/store', 'Admin\ProductController@store')->name('admin.products.store');
           Route::get('/edit/{id}', 'Admin\ProductController@edit')->name('admin.products.edit');
           Route::post('/update', 'Admin\ProductController@update')->name('admin.products.update');

           Route::post('images/upload', 'Admin\ProductImageController@upload')->name('admin.products.images.upload');
           Route::get('images/{id}/delete', 'Admin\ProductImageController@delete')->name('admin.products.images.delete');

           Route::get('attributes/load', 'Admin\ProductAttributeController@loadAttributes');
           Route::post('attributes', 'Admin\ProductAttributeController@productAttributes');
           Route::post('attributes/values', 'Admin\ProductAttributeController@loadValues');
           Route::post('attributes/add', 'Admin\ProductAttributeController@addAttribute');
           Route::post('attributes/delete', 'Admin\ProductAttributeController@deleteAttribute');

        });

        Route::group(['prefix' => 'orders'], function () {
           Route::get('/', 'Admin\OrderController@index')->name('admin.orders.index');
           Route::get('/{order}/show', 'Admin\OrderController@show')->name('admin.orders.show');
           Route::get('/show/{order}', 'Admin\OrderController@notificationShow')->name('admin.orders.notificationShow');
           Route::get('/{order}/edit', 'Admin\OrderController@edit')->name('admin.orders.edit');
           Route::post('/order/update', 'Admin\OrderController@update')->name('ordersUpdate');
           Route::get('/orders/pdf/{id}', 'Admin\OrderController@getOrderPdf')->name('admin.orders.pdf');
           Route::get('get-top-orders', 'Admin\OrderController@getOrdersData');
        });

        Route::group(['prefix' => 'requestproducts'], function () {
            Route::get('/', 'Admin\RequestProductController@index')->name('admin.productrequest');
            Route::get('/{item}/show', 'Admin\RequestProductController@show')->name('admin.productrequest.show');
         });
    });
});
