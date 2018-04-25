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

// Route::get('/', function () {
//     return view('home.index');
// });

// Route::get('/login', 'LoginController@index');
// Route::put('/login', 'LoginController@check');
// Route::any('/logout', 'LoginController@getLogout');

Route::any('/register', 'RegisterController@save');

Route::get('/register-payment', function () {
    return view('register.payment');
});

Route::get('/register-complete', function () {
    return view('register.complete');
});

Route::get('/history', 'ManageController@history');

Route::get('/', 'DashboardController@index');
Route::get('/dashboard', 'DashboardController@index');


Route::get('users/{user}/edit', 'UsersController@edit');
Route::get('users/{user}/retoken', 'UsersController@retoken');
Route::put('users/{user}', 'UsersController@update');
Route::get('users', 'UsersController@index');
Route::post('users', 'UsersController@store');
Route::post('users/search', 'UsersController@search');


Route::get('manage/request', 'ManageController@index_request');
Route::get('r2sup/accept/{user_id}', 'ManageController@r2sup_accept');
Route::get('r2sup/decline/{user_id}', 'ManageController@r2sup_decline');
Route::get('manage/request/leave', 'ManageController@index_request_leave');
Route::get('manage/request/leave/{subordinate_id}/accept', 'ManageController@leave_accept');
Route::get('manage/request/leave/{subordinate_id}/decline', 'ManageController@leave_decline');
Route::post('leave/search', 'ManageController@search');

Route::get('leave', 'LeavesController@index');
Route::put('leave','LeavesController@store');

Route::get('setting', 'DashboardController@index_Setting');
Route::get('setting/r2sup', 'DashboardController@r2sup');
Route::get('request', 'DashboardController@getRequest');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
