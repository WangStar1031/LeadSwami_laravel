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
			'apiKey' => '817ghsoujbnznd',
			'apiSecret' => 'QgrxQm1Dsup3D5J9',
			'callbackUrl' => 'http://mytest.com:8000/dashboard',
		));
		$url = $linkedin->getLoginUrl();
		return $url;
	}
}
