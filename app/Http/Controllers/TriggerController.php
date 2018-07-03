<?php

namespace App\Http\Controllers;

use DB;
use Request;

class TriggerController extends Controller
{
	public static function GetProfileDataFromZapier(Request $request){

		$access_token = Request::input('Authorization');

		$user = DB::select('select * from users where AccessTocken = ?', [$access_token]);
		if( count($user) == 0){
			return response(json_encode(array()), 200)->header('Content-Type', 'application/json');
		}
		$userId = $user[0]->Id;
		$profiles = DB::select('select * from duplication_profiles where UserId = ? and ZapTag <> 1', [$userId]);
		if( count($profiles) == 0){
			return response(json_encode(array()), 200)->header('Content-Type', 'application/json');
		}
		$retVal = array();
		$ids = array();
		for( $i = 0; $i < count($profiles); $i++){
			$curProfile = $profiles[$i];
			$profile = new \stdClass;
			$profile->id = (is_null($curProfile->Id) ? '': $curProfile->Id);
			$profile->name = (is_null($curProfile->Name) ? '': $curProfile->Name);
			$profile->lastname = (is_null($curProfile->LastName) ? '': $curProfile->LastName);
			$profile->headline = (is_null($curProfile->Headline) ? '': $curProfile->Headline);
			$profile->location = (is_null($curProfile->Location) ? '': $curProfile->Location);
			$profile->url = (is_null($curProfile->Url) ? '': $curProfile->Url);
			$profile->email = (is_null($curProfile->Email) ? '': $curProfile->Email);
			$profile->imgurl = (is_null($curProfile->ImgUrl) ? '': $curProfile->ImgUrl);
			$profile->phonenumber = (is_null($curProfile->PhoneNumber) ? '': $curProfile->PhoneNumber);
			$profile->lastjob = (is_null($curProfile->LastJob) ? '': $curProfile->LastJob);
			$profile->twitter = (is_null($curProfile->Twitter) ? '': $curProfile->Twitter);
			$profile->site = (is_null($curProfile->Site) ? '': $curProfile->Site);
			$profile->tag = (is_null($curProfile->Tag) ? '': $curProfile->Tag);
			array_push( $retVal, $profile);
			array_push($ids, $curProfile->Id);
		}
		$inclouse = implode(',', $ids);
		DB::update('update duplication_profiles set ZapTag = 1 where Id in (?)', [$inclouse]);
		return response(json_encode($retVal), 200)->header('Content-Type', 'application/json');
	}
}
