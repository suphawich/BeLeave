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

Route::get('subscription/{users}', 'SubscriptionController@index');

Route::any('/register', 'RegisterController@save');
Route::put('/register/regissubordinate','RegisterController@regissub');
Route::get('/register/{user}/payment/{plan}', 'RegisterController@payment');
Route::put('/register/{user}/payments/{plan}/update', 'RegisterController@updatepayment');
Route::put('/register/{user}/payments/{plan}/edit', 'RegisterController@editpro');
Route::any('/register/{token}','RegisterController@registoken');


Route::get('/register-complete', function () {
    return view('register.complete');
});

Route::get('/history', 'ManageController@history');





Route::get('/', 'DashboardController@index');
Route::get('/dashboard', 'DashboardController@index');


Route::get('users/{user}/edit', 'UsersController@edit');
Route::get('users/{user}/retoken', 'UsersController@retoken');
Route::get('users/{user}/delete', 'UsersController@destroy');
Route::get('users/{id}/profile', 'UsersController@show');
Route::put('users/{user}/account', 'UsersController@update_account');
Route::put('users/{user}', 'UsersController@update');
Route::get('users', 'UsersController@index');
Route::post('users', 'UsersController@store');
Route::put('users', 'UsersController@search');


Route::get('manage/request', 'ManageController@index_request');
Route::get('r2sup/accept/{user_id}', 'ManageController@r2sup_accept');
Route::get('r2sup/decline/{user_id}', 'ManageController@r2sup_decline');
Route::get('manage/request/leave', 'ManageController@index_request_leave');
Route::get('manage/request/leave/{subordinate_id}/accept', 'ManageController@leave_accept');
Route::get('manage/request/leave/{subordinate_id}/decline', 'ManageController@leave_decline');
Route::post('leave/search', 'ManageController@search');

Route::get('leave', 'LeavesController@index');
Route::put('leave','LeavesController@store');

Route::get('graph','AnalyticController@index');
Route::put('graph','AnalyticController@index');
Route::get('graphadmin','AnalyticController@index_admin');
Route::put('graphadmin','AnalyticController@index_admin');
Route::get('detailadmin','AnalyticController@index_detail_admin');
Route::get('logs/user', 'LogsController@index_userlog');
Route::put('logs/user', 'LogsController@index_userlog');
Route::get('logs/system', 'LogsController@index_systemlog');
Route::put('logs/system', 'LogsController@index_systemlog');


Route::get('setting', 'DashboardController@index_Setting');
Route::get('setting/r2sup', 'DashboardController@r2sup');
Route::get('request', 'DashboardController@getRequest');



Route::get('account/accounts', 'UsersController@index_account');
Route::put('account/accounts', 'UsersController@search_account');
Route::get('account/switchuser', 'UsersController@index_switchuser');

Route::get('read/manage/request/leave', 'NotificationsController@markAsRead_manageRequestLeave');
Route::get('noti', function () {

    $user = Auth::user();
    $user->notify(new \App\Notifications\RequestLeaveNotification($user));

});

Route::get('noti/receive', function () {

    $user = Auth::user();
    echo "<pre>";
    print_r($user->notifications);
    echo "</pre>";
    // foreach ($user->unreadnotifications as $noti) {
    //     print_r($noti->data);
    // }

});


Route::get('sendmail', function () {
    $data = array('name' => 'Mark');
    Mail::send('email.email', $data, function ($message) {
        // $message->to('suphawich.s@ku.th', 'Suphawich')
        $message->to('tanya.pa@ku.th', 'Suphawich')
                ->subject('Regitered');
        $message->from('beleavemanagement@gmail.com', 'Suphawich');
    });
    echo "Sent email, compelete";
});


Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::get('/plan','PlanController@index');


//pdf
Route::get('/getPDFRequestLeave','ManageController@getPDFRequestLeave');
Route::get('/getPDFRequest','ManageController@getPDFRequest');
Route::get('/getPDFHistory','ManageController@getPDFHistory');
Route::get('/getPDFUsers','UsersController@getPDFUser');
