<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use DB;
use Redirect;
// use Request;

class UserInfoController extends Controller
{
	public static function insertPersonalData(Request $request){
		$Email = $request->Email;
		$ProfileUrl = $request->ProfileUrl;
		$PicUrl = $request->PicUrl;
		$Location = $request->Location;
		$user = DB::select('select Id from users where Email = ?', [$Email]);
		if( count($user) == 0){
			return response()->json(['msg'=>'Not matching.']);
		}
		DB::update('update users set Location = ?, ProfilePicUrl = ?, PublicUrl = ? where Email = ?',[$Location, $PicUrl, $ProfileUrl, $Email]);
		return response()->json(['msg'=>'Updated.']);
	}
	public static function updateConnectionCount(Request $request){
		$Email = $request->Email;
		$ConnectionNumber = (int)str_replace(',', '', $request->ConnectionNumber);
		$user = DB::select('select Id from users where Email = ?', [$Email]);
		if( count($user) == 0){
			return response()->json(['msg'=>'Not matching.']);
		}
		DB::update('update users set ConnectionCount = ? where Email = ?',[$ConnectionNumber, $Email]);
		return response()->json(['msg'=>'Updated.']);
	}
	public static function SaveProfiles(Request $request){
		$Email = $request->Email;
		$user = DB::select('select Id from users where Email = ?', [$Email]);
		if( count($user) == 0){
			return response()->json(['msg'=>'Not matching.']);
		}
		$Id = $user[0]->Id;
		$profile = $request->objProfile;
		$strName = $profile['strName'];
		$strLastName = $profile['strLastName'];
		$strHeadLine = $profile['strHeadLine'];
		$strLocation = $profile['strLocation'];
		$strProfile = $profile['strProfile'];
		$strEmail = $profile['strEmail'];
		$strImgUrl = $profile['strImgUrl'];
		$strTwitter = $profile['strTwitter'];
		$strPhoneNumber = $profile['strPhoneNumber'];
		$strLastJob = $profile['strLastJob'];
		$strSite = $profile['strSite'];
		$strTag = $profile['strTag'];
		$profile = DB::select('select Id from profiles where UserId = ? and Email = ?', [$Id, $strEmail]);
		if( count($profile) != 0){
			return response()->json(['msg'=>'Already existed.']);
		}
		if( UserInfoController::DiscountCoupon($Email) == true){
			DB::insert('insert into profiles(UserId, Name, LastName, Headline, Location, Url, Email, ImgUrl, PhoneNumber, LastJob, Twitter, Site, Tag) values( ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)', [$Id, $strName, $strLastName, $strHeadLine, $strLocation, $strProfile, $strEmail, $strImgUrl, $strPhoneNumber, $strLastJob, $strTwitter, $strSite, $strTag]);
			return response()->json(['msg'=>'Inserted.']);
		}
		return response()->json(['msg'=>'Coupon Count Limited.']);
	}

	public static function deleteAccount($email){
		$user = DB::select('select Id from users where Email = ?', [$email]);
		if( count($user) == 0){
			return;
		}
		$userId = $user[0]->Id;
		DB::delete('delete from profiles where UserId = ?', [$userId]);
		DB::delete('delete from coupons where UserId = ?', [$userId]);
		DB::delete('delete from billing where UserId = ?', [$userId]);
		DB::delete('delete from billhistory where UserId = ?', [$userId]);
		DB::delete('delete from users where Email = ?', [$email]);

	}

	public static function getProfileData($email){
		$user = DB::select('select Id from users where Email = ?', [$email]);
		if( count($user) == 0){
			return array();
		}
		$userId = $user[0]->Id;
		$profiles = DB::select('select * from profiles where UserId = ?', [$userId]);
		return $profiles;
	}

	public static function SavePayMethod($email, Request $request){
		$payCode = $request->input('payCode');
		$user = DB::select('select Id from users where Email = ?', [$email]);
		if( count($user) == 0){
			return 0;
		}
		$userId = $user[0]->Id;
		$billData = DB::select('select Id from billing where UserId = ?', [$userId]);
		if( count($billData) == 0){
			DB::insert('insert into billing(UserId, StripeCardNumber) values(?,?)', [ $userId, $payCode]);
		} else{
			DB::update('update billing set StripeCardNumber = ? where UserId = ?',[ $payCode, $userId]);
		}
		return 1;
	}

	public static function SaveBillingDatas(Request $request){
		$email = $request->input('eMail');
		$user = DB::select('select Id from users where Email = ?', [$email]);
		if( count($user) == 0){
			return 0;
		}
		$userId = $user[0]->Id;
		$companyName = $request->input('companyName');
		$taxId = $request->input('taxVatID');
		$country = $request->input('country');
		$zipCode = $request->input('zipCode');
		$city = $request->input('city');
		$state = $request->input('state');
		$billData = DB::select('select Id from billing where UserId = ?', [$userId]);
		if( count($billData) == 0){
			DB::insert('insert into billing(UserId, CompanyName, TaxVatId, Country, ZipCode, City, State) values(?,?,?,?,?,?,?)', [ $userId, $companyName, $taxId, $country, $zipCode, $city, $state]);
		} else{
			DB::update('update billing set CompanyName = ?, TaxVatId = ?, Country = ?, ZipCode = ?, City = ?, State = ? where UserId = ?',[$companyName, $taxId, $country, $zipCode, $city, $state, $userId]);
		}
		return 1;
	}
	public static function GetBillingDatas($email){
		$user = DB::select('select Id from users where Email = ?', [$email]);
		if( count($user) == 0){
			return array();
		}
		$userId = $user[0]->Id;
		$billData = DB::select('select * from billing where UserId = ?', [$userId]);
		if( count($billData) == 0){
			$retObj = new \stdClass;
			$retObj->CompanyName = "";
			$retObj->TaxVatId = "";
			$retObj->Country = "";
			$retObj->ZipCode = "";
			$retObj->City =  "";
			$retObj->State = "";
			$retObj->StripeCardNumber = "";
			$retObj->ExpirationDate = "";
			$retObj->PromoCode = "";
			return $retObj;
		}
		return $billData[0];
	}
	public static function GetCardNumber($email){
		$user = DB::select('select Id from users where Email = ?', [$email]);
		if( count($user) == 0){
			return "";
		}
		$userId = $user[0]->Id;
		$card = DB::select('select StripeCardNumber from billing where UserId = ?', [$userId]);
		if( count($card) == 0){
			return "";
		}
		return $card[0]->StripeCardNumber;
	}
	public static function UpdateCardNumber($email, $postedCardNumber){
		$user = DB::select('select Id from users where Email = ?', [$email]);
		if( count($user) == 0){
			return;
		}
		$userId = $user[0]->Id;
		$card = DB::update('update billing set StripeCardNumber=? where UserId = ?', [ $postedCardNumber, $userId]);
		return;
	}
	public static function SavePromoCode($email, $request){
		$user = DB::select('select Id from users where Email = ?', [$email]);
		if( count($user) == 0){
			return;
		}
		$userId = $user[0]->Id;
		$PromoCode = $request->input('promoCode');
		DB::update('update billing set PromoCode = ? where UserId = ?', [ $PromoCode, $userId]);
		return;
	}
	public static function updateExpirationDate($email, $date){
		$user = DB::select('select Id from users where Email = ?', [$email]);
		if( count($user) == 0){
			return;
		}
		$userId =  $user[0]->Id;
		DB::update('update billing set ExpirationDate = ? where UserId = ?',[$date, $userId]);
	}
	public static function updateBillingData($email, $description, $amount, $expDate){
		$user = DB::select('select Id from users where Email = ?', [$email]);
		if( count($user) == 0){
			return;
		}
		$userId = $user[0]->Id;
		DB::insert('insert into billhistory(UserId, BillDate, Description, Amount, ExpDate) values(?,?,?,?,?)', [$userId, date('Y-m-d'), $description, $amount, $expDate]);
	}
	public static function GetBillHistory($email){
		$user = DB::select('select Id from users where Email = ?', [$email]);
		if( count($user) == 0){
			return array();
		}
		$userId = $user[0]->Id;
		$history = DB::select('select * from billhistory where UserId = ?', [$userId]);
		return $history;
	}
	public static function getUserName($email){
		$user = DB::select('select Name, SurName from users where Email = ?', [$email]);
		return $user[0]->Name . " " . $user[0]->SurName;
	}
	public static function getUserAvatar($email){
		$user = DB::select('select ProfilePicUrl from users where Email = ?', [$email]);
		return $user[0]->ProfilePicUrl;
	}
	public static function getUserFirstName($email){
		$user = DB::select('select Name from users where Email = ?', [$email]);
		return $user[0]->Name;
	}
	public static function getUserLastName($email){
		$user = DB::select('select SurName from users where Email = ?', [$email]);
		return $user[0]->SurName;
	}
	public static function my_simple_crypt( $string, $action = 'e' ) {
		// you may change these values to your own
		$secret_key = 'my_simple_secret_key';
		$secret_iv = 'my_simple_secret_iv';

		$output = false;
		$encrypt_method = "AES-256-CBC";
		$key = hash( 'sha256', $secret_key );
		$iv = substr( hash( 'sha256', $secret_iv ), 0, 16 );

		if( $action == 'e' ) {
			$output = base64_encode( openssl_encrypt( $string, $encrypt_method, $key, 0, $iv ) );
		}
		else if( $action == 'd' ){
			$output = openssl_decrypt( base64_decode( $string ), $encrypt_method, $key, 0, $iv );
		}

		return $output;
	}
	public static function loginWithLinkedinUserInfo($_email, $_info, $picUrl){
		$users = DB::select('select * from users where Email = ?', [$_email]);
		if( count($users))
			return '';
		$arrInfos = array();
		array_push( $arrInfos, $_info->firstName);
		array_push( $arrInfos, $_info->lastName);
		array_push( $arrInfos, $_email);
		array_push( $arrInfos, $_info->headline);
		array_push( $arrInfos, $_info->siteStandardProfileRequest->url);
		$planText = $_email;// . $_info->firstName . $_info->lastName;
		$password =  UserInfoController::my_simple_crypt( $planText, 'e' );
		DB::insert('insert into users(Name, SurName, Email, Headline, PublicUrl, ProfilePicUrl, Password, AccessTocken) values(?,?,?,?,?,?,?,?)', [$_info->firstName,$_info->lastName, $_email, $_info->headline, $_info->siteStandardProfileRequest->url, $picUrl, $password, $password]);
		UserInfoController::SetCouponData0($_email);
		return $password;
	}
	public static function SetCouponData0($email){
		$users = DB::select('select Id from users where Email = ?', [$email]);
		if( count($users) == 0){
			return;
		}
		$userId = $users[0]->Id;
		$curDate = strtotime(date('Y-m-d'));
		if( date('d') == 31 || (date('m') == 1 && date('d') > 28)){
			$date = strtotime('last day of next month', $curDate);
		} else {
			$date = strtotime('+1 months', $curDate);
		}
		DB::insert('insert into coupons(UserId, LastPendingDate, RemainingCount) values(?,?,?)', [$userId, date( 'Y-m-d', $date), 10]);
	}
	public static function GetRemainingCount($email){
		$users = DB::select('select Id from users where Email = ?', [$email]);
		if( count($users) == 0){
			return 0;
		}
		$userId = $users[0]->Id;
		$count = DB::select('select RemainingCount from coupons where UserId = ?', [$userId]);
		if( count($count) == 0){
			UserInfoController::SetCouponData0($email);
			return 10;
		}
		return $count[0]->RemainingCount;
	}
	public static function DiscountCoupon($email){
		$expDate = strtotime(UserInfoController::GetBillingDatas($email)->ExpirationDate);
		$curDate = strtotime(date('Y-m-d'));
		if( $curDate < $expDate){
			return true;
		}
		$count = UserInfoController::GetRemainingCount($email);
		$users = DB::select('select Id from users where Email = ?', [$email]);
		$userId = $users[0]->Id;
		$pendingData = DB::select('select LastPendingDate from coupons where UserId = ?', [$userId]);
		$pendingDate = date($pendingData[0]->LastPendingDate);
		$curPending = strtotime($pendingDate);
		$curDate = strtotime(date('Y-m-d'));
		while( $curPending < $curDate){
			if( date('d', $curPending) == 31 || (date('m', $curPending) == 1 && date('d', $curPending) > 28)){
				$curPending = strtotime('last day of next month', $curPending);
			} else {
				$curPending = strtotime('+1 months', $curPending);
			}
		}
		if( $curPending == strtotime($pendingDate)){
			if( $count == 0){
				return false;
			}
			$count --;
			DB::update('update coupons set RemainingCount = ? where UserId = ?', [$count, $userId]);
			return true;
		}
		DB::update('update coupons set LastPendingDate = ?, RemainingCount = ? where UserId = ?', [$curPending->format('Y-m-d'), $count-1, $userId]);
		return true;
	}
	public static function matchingPassword($email, $pass){
		$user = DB::select('select * from users where Email = ?', [$email]);
		if( count($user) == 0){
			return false;
		}
		if( strcmp($user[0]->Password, $pass) == 0){
			return true;
		}
		return false;
	}
	public static function changePassword($email, $pass){
		DB::update('update users set Password = ? where Email = ?', [$pass, $email]);
	}
	public static function updateUserName($email, $firstName, $lastName){
		DB::update('update users set Name = ?, SurName = ? where Email = ?', [$firstName, $lastName, $email]);
	}
	public static function getUserPassword($email){
		$user = DB::select('select Password from users where Email = ?', [$email]);
		if( count($user) == 0){
			return '';
		}
		return $user[0]->Password;
	}
}
