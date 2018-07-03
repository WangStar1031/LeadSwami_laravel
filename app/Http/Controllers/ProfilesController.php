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
		// print_r(UserInfoController::getProfileData($email));
		// exit();
		return view('profiles', ['email'=>$email, 'profiles'=>UserInfoController::getProfileData($email), 'orderIndex'=>'-1', 'orderDir'=>'']);
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
			return view('profiles', ['email'=>$email, 'profiles'=>$searched, 'orderIndex'=>'-1', 'orderDir'=>'']);
		} else if( $method == 'delete'){
			$proIds = $request->input('proIDs');
			UserInfoController::removeProfiles($proIds);
			// exit();
			return redirect('/profiles');
		} else if( $method == 'sort'){
			$sortOption = $request->input('proIDs');
			$arrOptions = explode(",", $sortOption);
			$sortField = $arrOptions[0];
			$strFldName = '';
			switch ($sortField) {
				case '0': $strFldName = "Name";	break;
				case '1': $strFldName = "LastName";	break;
				case '2': $strFldName = "Headline";	break;
				case '3': $strFldName = "Location";	break;
				case '4': $strFldName = "Url";	break;
				case '5': $strFldName = "Email";	break;
				case '6': $strFldName = "PhoneNumber";	break;
				case '7': $strFldName = "LastJob";	break;
				case '8': $strFldName = "Twitter";	break;
				case '9': $strFldName = "Site";	break;
				case '10': $strFldName = "Tag";	break;
			}
			$sortMethod = $arrOptions[1];
			$profiles = UserInfoController::sortProfiles($email, $strFldName, $sortMethod);
			return view('profiles', ['email'=>$email, 'profiles'=>$profiles, 'orderIndex'=>$sortField, 'orderDir'=>$sortMethod]);
		}
	}
}
