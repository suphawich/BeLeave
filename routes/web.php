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

Route::get('/', function () {
    return view('home.index');
});

Route::any('/login', 'LoginController@index');

Route::any('/register', 'RegisterController@save');

Route::get('/register-payment', function () {
    return view('register.payment');
});

Route::get('/dashboard', function () {
    return view('dashboard.index');
});

Route::get('/register-complete', function () {
    return view('register.complete');
});
