<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ProfilesController extends Controller
{
	public function index(Request $request){
		$email = "";
		if( $request->session()->has('LeadswamiAdmin')){
			$email = $request->session()->get('LeadswamiAdmin');
		} else{
			return redirect('/');
		}
		return view('profiles', ['email'=>$email, 'profiles'=>UserInfoController::getProfileData($email)]);
	}
	public function postMethod(Request $request){
		$email = "";
		if( $request->session()->has('LeadswamiAdmin')){
			$email = $request->session()->get('LeadswamiAdmin');
		} else{
			return redirect('/');
		}
		$method = $request->input('proCat');
		if( $method == 'search'){
			$searchOption = $request->input('proSearch');
			if( $searchOption == '')
				return redirect('/profiles');
			$searched = UserInfoController::getProfileSearch($email, $searchOption);
			return view('profiles', ['email'=>$email, 'profiles'=>$searched]);
		} else{
			$proIds = $request->input('proIDs');
			UserInfoController::removeProfiles($proIds);
			// exit();
			return redirect('/profiles');
		}
	}
}
