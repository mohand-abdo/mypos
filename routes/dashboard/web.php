<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/


Route::group(['prefix' => LaravelLocalization::setLocale(), 'middleware' => ['localeSessionRedirect', 'localizationRedirect', 'localeViewPath']], function () {

    Route::prefix('dashboard')->name('dashboard.')->group(function () {

        Route::get('/', 'WelcomeController@index')->name('welcome');

        /* categories-route */
        Route::resource('/categories', 'CategoryController')->except('show');

        /* products-route */
        Route::resource('/products', 'ProductController')->except('show');

        /* clients route */
        Route::resource('/clients', 'ClientController')->except('show');
        Route::resource('/clients.orders', 'Client\OrderController')->except(['index', 'show', 'destroy']);

        //orders route
        Route::resource('/orders', 'OrderController')->only(['index', 'show', 'destroy']);

        /* users-route */
        Route::resource('/users', 'UserController');
        Route::post('/users/changePassword', 'UserController@changePassword')->name('users.changePassword');
    });
});
