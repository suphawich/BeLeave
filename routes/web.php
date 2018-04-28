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

Route::get('subscription/{users}', function(){
    return view('subscription.index');
});

Route::any('/register', 'RegisterController@save');

Route::get('/register/{user}/payment/{plan}', 'RegisterController@payment');

Route::get('/register-complete', function () {
    return view('register.complete');
});
Route::put('/register/{user}/payments/{plan}/update', 'RegisterController@updatepayment');

Route::get('/history', 'ManageController@history');


Route::get('/', function(){
    return view('home.index');
});
Route::post('/', function() {
    return 'Hello';
});
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

Route::get('read/manage/request/leave/{user}', 'NotificationsController@markAsRead_manageRequestLeave');
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

// Route::get('line', function (Illuminate\Http\Request $request) {
//     $code = $request->input('code');
//     // $state = $request->input('state');
//     //
//     // $header = [
//     //     'Content-type: application/x-www-form-urlencoded',
//     // ];
//     $post_field = [
//         'grant_type' => $code,
//         'code' => $code,
//         'redirect_uri' => 'http://localhost:7000/line2',
//         'client_id' => '1577161245',
//         'client_secret' => 'e4972f1ad230526f98a204206a019f41'
//     ];
//     //
//     // $ch = curl_init();
//     // curl_setopt($ch, CURLOPT_URL,"https://api.line.me/oauth2/v2.1/token");
//     // // curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
//     // // curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
//     // curl_setopt($ch, CURLOPT_POST, 1);
//     // curl_setopt($ch, CURLOPT_HTTPHEADER, $header);
//     // curl_setopt($ch, CURLOPT_POSTFIELDS, $post_field);
//     // curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
//     // $data = curl_exec($ch);
//
// //     $curl = curl_init();
// //
// //     curl_setopt_array($curl, array(
// //       CURLOPT_URL => "https://api.line.me/v2/oauth/accessToken",
// //       CURLOPT_RETURNTRANSFER => true,
// //       CURLOPT_ENCODING => "",
// //       CURLOPT_MAXREDIRS => 10,
// //       CURLOPT_TIMEOUT => 30,
// //       CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
// //       CURLOPT_CUSTOMREQUEST => "POST",
// //       CURLOPT_POSTFIELDS => http_build_query($post_field),
// // //       CURLOPT_POSTFIELDS => 'grant_type=authorization_code&code='.$code.'&client_id=1577161245&client_secret=921f418b2e4838baa4f8b0662e98f6ac
// // // &redirect_uri=http://localhost:7000/line2',
// //       // CURLOPT_POSTFIELDS => "{\"grant_type\":\"authorization_code\",\"client_id\": \"1577161245\",\"client_secret\": \"921f418b2e4838baa4f8b0662e98f6ac\",\"code\": \"".$code."\",\"redirect_uri\": \"http://localhost:7000/line2\"}",
// //       // CURLOPT_HTTPHEADER => array(
// //       //   "content-type: application/x-www-form-urlencoded"
// //       //   // "content-type: application/json"
// //       // ),
// //       CURLOPT_HTTPHEADER => array(
// //         "content-type: application/x-www-form-urlencoded"
// //         // "content-type: application/json"
// //       ),
// //     ));
//
//     // $response = curl_exec($curl);
//     // $err = curl_error($curl);
//     // curl_close($curl);
//
//     // return $response;
// });

Route::get('line', 'UsersController@hello');
Route::any('line2', 'UsersController@hello2');



Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::get('/plan','PlanController@index');
