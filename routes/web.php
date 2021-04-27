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
    return view('auth.login');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::get('/sms/dashboard', 'SMSDashboard@sms_dashboard')->name('sms-dashboard');
Route::get('/completed/task', 'CompletedTask@completed_task')->name('task_completed');
Route::get('/other/sms/dashboard', 'OtherMessages@other_sms_dashboard')->name('other-sms');
Route::get('/failed/sms/dashboard', 'FailedMessages@view_failedsms')->name('failed-sms');

Route::get('/phone/call/{internalkey}', 'SMSDashboard@phone_call');
Route::get('/phone/message/{internalkey}/{remarks}', 'SMSDashboard@message');
Route::get('/phone/tix/{internalkey}/{tixnum}', 'SMSDashboard@tix_number');

Route::get('/recv/msgs', 'SMSDashboard@recvmsg_ajax');
Route::get('/msglog/{internalkey}', 'CompletedTask@json_msglog');