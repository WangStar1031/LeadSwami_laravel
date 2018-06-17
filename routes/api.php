<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
Route::post('/PersonalData/', 'UserInfoController@insertPersonalData');
Route::post('/ConnectionCount/', 'UserInfoController@updateConnectionCount');
Route::post('/SaveProfiles/', 'UserInfoController@SaveProfiles');

Route::get('/PersonalData/', 'UserInfoController@insertPersonalData');
Route::get('/ConnectionCount/', 'UserInfoController@updateConnectionCount');
Route::get('/SaveProfiles/', 'UserInfoController@SaveProfiles');

Route::get('/authZapier/', 'ZapierController@verifyFromZapier');
Route::get('/accessZapier/', 'ZapierController@accessFromZapier');

Route::post('/accessZapier/', 'ZapierController@accessFromZapier');

Route::post('/oauthZapier/submit', 'ZapierController@oauthZapierSubmit');
Route::get('/user','ZapierController@getUserInfo');

Route::get('/newProfiles', 'TriggerController@GetProfileDataFromZapier');