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

Route::any('/login', 'LoginController@check');
Route::any('/logout', 'LoginController@getLogout');

Route::any('/register', 'RegisterController@save');

Route::get('/register-payment', function () {
    return view('register.payment');
});

Route::get('/register-complete', function () {
    return view('register.complete');
});

Route::get('/dashboard', 'DashboardController@check');
Route::any('/profile', 'DashboardController@getProfile');
Route::any('edit-profile', 'ProfileController@edit');
Route::get('change-password', 'DashboardController@getChangepwd');
Route::get('users', 'DashboardController@getUsers');
Route::get('re-token', 'UsersController@retoken');
