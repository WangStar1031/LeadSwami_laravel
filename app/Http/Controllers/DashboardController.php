<?php

namespace App\Http\Controllers;

use Illuminate\Http\Response;
use Illuminate\Http\Request;
use App\Classes\LinkedIn;

class DashboardController extends Controller
{
	public function index(Request $request){
		$code = $request->input('code');
		if( $request->session()->has('LeadswamiAdmin')){
			$email = $request->session()->get('LeadswamiAdmin');
		} else if( $code != ''){
			$linkedin = new LinkedIn(array(
				'apiKey' => env('LINKEDIN_API_KEY', ''),
				'apiSecret' => env('LINKEDIN_API_SECRET', ''),
				'callbackUrl' => env('LINKEDIN_CALLBACK_URL',''),
			));
			$token = $linkedin->getAccessToken($code);
			$linkedin->setAccessToken($token);
			$options = ":(first-name,last-name,headline,picture-url)";
			$info = $linkedin->get('/people/~', $options);
			$emailObj = $linkedin->get('/people/~:(email-address)',"");
			$picUrl = $linkedin->get('/people/~:(picture-url)',"");
			$url = $info->siteStandardProfileRequest->url;
			// print_r($info);
			// print_r($picUrl);
			// return;
			app('App\Http\Controllers\UserInfoController')->loginWithLinkedinUserInfo($emailObj->emailAddress, $info, $picUrl->pictureUrl);
			$request->session()->put('LeadswamiAdmin', $emailObj->emailAddress);
			$email = $emailObj->emailAddress;
		} else{
			return redirect('/');
		}
		return view('dashboard', ['email'=>$email]);
	}
	public function delAccount(Request $request){
		if( $request->session()->has('LeadswamiAdmin')){
			$email = $request->session()->get('LeadswamiAdmin');
		} else{
			return redirect('/');
		}
		UserInfoController::deleteAccount($email);
		$request->session()->forget('LeadswamiAdmin');
		return redirect('/');
	}
}