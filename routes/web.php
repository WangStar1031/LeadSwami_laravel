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
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Credentials: true');

Route::get('/', 'WelcomeController@index');
// Route::get('/', function () {
//     return view('welcome');
// });

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::get('/dashboard', 'DashboardController@index');
Route::post('/delaccount', 'DashboardController@delAccount');
Route::get('/payment', 'PaymentController@index');
Route::post('/payment', 'PaymentController@postBillingData');

Route::get('/subscription', 'SubscriptionController@index');
Route::post('/subscription', 'SubscriptionController@postPlan');

Route::get('/profiles', 'ProfilesController@index');
Route::get('/logout', 'LogoutController@index');

Route::post('/savePromoCode', 'PaymentController@postPromoCode');
