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
				'apiKey' => '817ghsoujbnznd',
				'apiSecret' => 'QgrxQm1Dsup3D5J9',
				'callbackUrl' => 'http://mytest.com:8000/dashboard',
			));
			$token = $linkedin->getAccessToken($code);
			$linkedin->setAccessToken($token);
			$options = ":(first-name,last-name,headline,picture-url)";
			$info = $linkedin->get('/people/~', $options);
			$emailObj = $linkedin->get('/people/~:(email-address)',"");
			$url = $info->siteStandardProfileRequest->url;
			app('App\Http\Controllers\UserInfoController')->loginWithLinkedinUserInfo($emailObj->emailAddress, $info);
			$request->session()->put('LeadswamiAdmin', $emailObj->emailAddress);
			$email = $emailObj->emailAddress;
		} else{
			return redirect('/');
		}
		return view('dashboard', ['email'=>$email]);
	}
}