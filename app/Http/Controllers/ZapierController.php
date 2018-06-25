<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use DB;
use Redirect;
// use Request;
use App\Mail\TestEmail;

class ZapierController extends Controller
{

	public static function oauthZapierSubmit(Request $request){
		$client_id = $request->input('client_id');
		$redirect_uri = $request->input('redirect_uri');
		$email = $request->input('email');
		$password = $request->input('password');
		$state = $request->input('state');
		if( ZapierController::authenticateUser($email, $password) != 0){
			$user = DB::select('select AccessTocken from users where Email = ? and Password = ?', [$email, $password]);
			return redirect($redirect_uri . '?code=' . $user[0]->AccessTocken . '&state='.$state);
		}
		return redirect($redirect_uri . '?error=authentication failure&error_description=invalid email or password');
	}

	public static function verifyFromZapier(Request $request){
		// var_dump($request);
		// exit();
		$client_ID = $request->input('client_id');
		$redirect_uri = $request->input('redirect_uri');
		$state = $request->input('state');
		$avatar = '';
		$email = $request->input('email');
		if( $email)
			$avatar = UserInfoController::getUserAvatar( $email);
		return view('authZapier', ['email'=>$email, 'avatar'=>$avatar, 'client_id'=>$client_ID, 'redirect_uri'=>$redirect_uri, 'state'=>$state]);
	}
	public static function getUserInfo(Request $request){
		// $access_token = $request->input('access_token');
		// $user = DB::select('select * from users');
		// if( count($user) != 0){
		// 	$email = $user[0]->Email;
			$username = new \stdClass;
			$username->username = 'info@leadswami.com';
			return response(json_encode($username), 200)->header('Content-Type', 'application/json');
			// echo json_encode($username);
		// }
		// return null;
	}
	public static function accessFromZapier(Request $request){
		$code = $request->input('code');
		
		$user = DB::select('select * from users where AccessTocken = ?', [$code]);
		if( count($user) == 0){
			exit();
		}
		$retVal = new \stdClass;
		$retVal->access_token = $user[0]->AccessTocken;
		$retVal->expires_in = 3600;
		$retVal->token_type = 'Bearer';
		$retVal->scope = null;
		$userInfo = new \stdClass;
		$userInfo->username = $user[0]->Name . ' ' . $user[0]->SurName;
		$retVal->user = $userInfo;

		return response(json_encode($retVal), 200);
	}
	public static function authenticateUser($email, $password){
		$user = DB::select('select * from users where Email = ?', [$email]);
		if( count($user) == 0)
			return 0;
		if( strcmp($user[0]->Password, $password) == 0)
			return $user[0]->Id;
		return 0;
	}}
