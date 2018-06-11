<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Classes\LinkedIn;

class WelcomeController extends Controller
{
	public function index(Request $request){
		if( !$request->session()->has('LeadswamiAdmin')){
			return view('welcome');
		}
		return redirect('dashboard');
	}
	public static function getLoginUrl(){
		$linkedin = new LinkedIn(array(
			'apiKey' => env('LINKEDIN_API_KEY', '817ghsoujbnznd'),
			'apiSecret' => env('LINKEDIN_API_SECRET', 'QgrxQm1Dsup3D5J9'),
			'callbackUrl' => env('LINKEDIN_CALLBACK_URL','http://mytest.com:8000/dashboard'),
		));
		$url = $linkedin->getLoginUrl();
		return $url;
	}
}
