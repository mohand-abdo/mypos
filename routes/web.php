<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/



Route::get('/', function () {
    return redirect()->route('dashboard.welcome');
});
Auth::routes(['register' => false]);


// Route::get('admin/login', 'AdminController@login_get');
// Route::post('admin/login', 'AdminController@login_post');

Route::get('logining', function () {
    return 'Hi Mohand You are Loginging';
})->middleware('AdminAuth:webadmin');
