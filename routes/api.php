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

Route::get('/authZapier/', 'UserInfoController@verifyFromZapier');
Route::get('/accessZapier/', 'UserInfoController@accessFromZapier');

Route::post('/accessZapier/', 'UserInfoController@accessFromZapier');

Route::post('/oauthZapier/submit', 'UserInfoController@oauthZapierSubmit');
Route::get('/user','UserInfoController@getUserInfo');

Route::get('/newProfile', 'UserInfoController@GetProfileDataFromZapier');