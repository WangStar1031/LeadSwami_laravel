<?php

namespace App\Http\Controllers;

use Illuminate\Http\Response;
use Illuminate\Http\Request;
use App\Classes\LinkedIn;
use Mail;

class DashboardController extends Controller
{
	public function index(Request $request){
		$code = $request->input('code');
		if( $request->session()->has('LeadswamiAdmin')){
			$email = $request->session()->get('LeadswamiAdmin');
		} else if( $code != ''){
			$linkedin = new LinkedIn(array(
				'apiKey' => env('LINKEDIN_API_KEY', '817ghsoujbnznd'),
				'apiSecret' => env('LINKEDIN_API_SECRET', 'QgrxQm1Dsup3D5J9'),
				'callbackUrl' => env('LINKEDIN_CALLBACK_URL','http://mytest.com:8000/dashboard'),
			));
			$token = $linkedin->getAccessToken($code);
			$linkedin->setAccessToken($token);
			$options = ":(first-name,last-name,headline,picture-url)";
			$info = $linkedin->get('/people/~', $options);
			$emailObj = $linkedin->get('/people/~:(email-address)',"");
			$picUrl = $linkedin->get('/people/~:(picture-url)',"");
			$url = $info->siteStandardProfileRequest->url;

			$password = UserInfoController::loginWithLinkedinUserInfo($emailObj->emailAddress, $info, $picUrl->pictureUrl);
			$request->session()->put('LeadswamiAdmin', $emailObj->emailAddress);
			$email = $emailObj->emailAddress;

			$data = ['pass'=>$password];
			Mail::send('emails.welcome', $data, function($message) use ($email){
				$message->to($email, '')->subject('Welcome to Leadswami!');
				$message->from('info@leadswami.com','Leadswami');
			});
		} else{
			return redirect('/');
		}
		return view('dashboard', ['email'=>$email, 'matching' => '']);
	}
	public function forgotPassword(Request $request){
		if( $request->session()->has('LeadswamiAdmin')){
			$email = $request->session()->get('LeadswamiAdmin');
		} else{
			return redirect('/');
		}
		$pass = UserInfoController::getUserPassword($email);
		$data = ['pass'=>$pass];
		Mail::send('emails.welcome', $data, function($message) use ($email){
			$message->to($email, '')->subject('Welcome to Leadswami!');
			$message->from('info@leadswami.com','Leadswami');
		});
		return redirect('/dashboard');
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
	public function changePassword(Request $request){
		$email = "";
		if( $request->session()->has('LeadswamiAdmin')){
			$email = $request->session()->get('LeadswamiAdmin');
		} else{
			return redirect('/');
		}
		$curPass = $request->input('curPassword');
		if($curPass == ''){
			return redirect('/dashboard');
		}
		if( UserInfoController::matchingPassword($email, $curPass) == false){
			return view('dashboard', ['email'=>$email, 'matching' => 'curPass']);
		}
		$newPass = $request->input('newPassword');
		$conPass = $request->input('confirmPassword');
		if( strcmp($newPass, $conPass) != 0){
			return view('dashboard', ['email'=>$email, 'matching'=>'Not Matching']);
		}
		UserInfoController::changePassword($email, $newPass);
		return view('dashboard', ['email'=>$email, 'matching'=>'changed']);
	}
	public function changeName(Request $request){
		$email = "";
		if( $request->session()->has('LeadswamiAdmin')){
			$email = $request->session()->get('LeadswamiAdmin');
		} else{
			return redirect('/');
		}
		$firstName = $request->input('firstName');
		$lastName = $request->input('lastName');
		UserInfoController::updateUserName($email, $firstName, $lastName);
		return view('dashboard', ['email'=>$email, 'matching'=>'']);
	}
}