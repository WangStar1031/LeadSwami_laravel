<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use URL;
use Session;
use Redirect;
use Input;
use App\User;
use Stripe\Error\Card;
use Cartalyst\Stripe\Stripe;

class SubscriptionController extends Controller
{
	private static function getBillState($email){
		$billingData = UserInfoController::GetBillingDatas($email);
		$cardNumber = '';
		$isActive = 0;
		if( count($billingData)){
			$expDate = strtotime($billingData->ExpirationDate);
			$nextDate = strtotime('+1 days');
			if( $expDate > $nextDate){
				$isActive = 1;
			} else{
				$isActive = 0;
			}
			$cardNumber = $billingData->StripeCardNumber;
		}
		$retObj = new \stdClass;
		$retObj->isActive = $isActive;
		$retObj->cardNumber = $cardNumber;
		return $retObj;
	}
	public function index(Request $request){
		$email = "";
		if( $request->session()->has('LeadswamiAdmin')){
			$email = $request->session()->get('LeadswamiAdmin');
		} else{
			return redirect('/');
		}
		$billingData = SubscriptionController::getBillState($email);
		return view('subscription', ['email'=>$email, 'isActive'=>$billingData->isActive, 'cardNumber'=>$billingData->cardNumber, 'errMsg'=>'']);
	}
	public function postPlan(Request $request){
		$email = "";
		if( $request->session()->has('LeadswamiAdmin')){
			$email = $request->session()->get('LeadswamiAdmin');
		} else{
			return redirect('/');
		}
		$billingData = SubscriptionController::getBillState($email);
		$cardNumber = UserInfoController::GetCardNumber($email);
		$postedCardNumber = $request->input('cardNumber');
		$postedCardNumber = str_replace(' ', '', $postedCardNumber);
		if( $postedCardNumber == ''){
			return view('subscription', ['email'=>$email, 'isActive'=>$billingData->isActive, 'cardNumber'=>$billingData->cardNumber, 'errMsg'=>'* No Card Number. *']);
		}
		if( strlen($postedCardNumber) != 16){
			return view('subscription', ['email'=>$email, 'isActive'=>$billingData->isActive, 'cardNumber'=>$billingData->cardNumber, 'errMsg'=>'* Invalid Card Number. *']);
		}
		$expDate = $request->input('expDate');
		$arrDate = explode('/', $expDate);
		$expMonth = $arrDate[0];
		$expYear = $arrDate[1];
		if( $expDate == ''){
			return view('subscription', ['email'=>$email, 'isActive'=>$billingData->isActive, 'cardNumber'=>$billingData->cardNumber, 'errMsg'=>'* No Expiration Date. *']);
		}
		if( !is_numeric( $expMonth) || !is_numeric( $expYear)){
			return view('subscription', ['email'=>$email, 'isActive'=>$billingData->isActive, 'cardNumber'=>$billingData->cardNumber, 'errMsg'=>'* Invalid Expiration Date. *']);
		}
		// $a_date = $expYear . '-' . $expMonth . '-1';
		// $realExpDate = date("Y-m-t", strtotime($a_date));

		$cvcCard = $request->input('cardCode');
		if( $cvcCard == ''){
			return view('subscription', ['email'=>$email, 'isActive'=>$billingData->isActive, 'cardNumber'=>$billingData->cardNumber, 'errMsg'=>'* No CVC Code. *']);
		}
		if( strlen($cvcCard) != 3){
			return view('subscription', ['email'=>$email, 'isActive'=>$billingData->isActive, 'cardNumber'=>$billingData->cardNumber, 'errMsg'=>'* Invalid CVC Code. *']);
		}

		if( $cardNumber != $postedCardNumber){
			UserInfoController::UpdateCardNumber($email, $postedCardNumber);
		}
		$cardNumber = $postedCardNumber;
		$status = $request->input('status');
		$stripeSec = env('STRIPE_SECRET','');
		$stripe = Stripe::make($stripeSec);

		$billingData = UserInfoController::GetBillingDatas($email);
		if( count($billingData) == 0){
			return redirect('/payment');
		}
		$curExpDate = $billingData->ExpirationDate;
		if( $curExpDate == ''){
			$date = strtotime('+1 years');
		} else{
			// $date = strtotime('+1 years', $curExpDate);
			$date = date("Y-m-d", strtotime(date("Y-m-d", strtotime($curExpDate)) . " + 1 year"));
		}
		$amount = 29;
		$expiration = $date;
		try{
			$token = $stripe->tokens()->create([
				'card' => [
					'number' => $cardNumber,
					'exp_month' => $expMonth,
					'exp_year' => $expYear,
					'cvc' => '311',
				],
			]);
			if(!isset($token['id'])){
				return view('subscription', ['email'=>$email, 'isActive'=>$billingData->isActive, 'cardNumber'=>$billingData->cardNumber, 'errMsg'=>'* Error for getting Stripe token. *']);
			}
			$charge = $stripe->charges()->create([
				'card' => $token['id'],
				'currency' => 'USD',
				'amount' => 29,
				'description' => 'Add in wallet',
			]);

			if($charge['status'] == 'succeeded'){
				// Write Here your Database insert logic.
				UserInfoController::updateExpirationDate($email, $expiration);
				UserInfoController::updateBillingData($email, 'Add in wallet', $amount, $expiration);
				return redirect('/subscription');
			} else{
				\Session::put('error', 'Money not add in wallet!!');
				return view('subscription', ['email'=>$email, 'isActive'=>$billingData->isActive, 'cardNumber'=>$billingData->cardNumber, 'errMsg'=>'* Money not add in wallet. *']);
				// return redirect('/payment');
			}
		} catch(Exception $e){
			\Session::put('error', $e->getMessage());
			return view('subscription', ['email'=>$email, 'isActive'=>$billingData->isActive, 'cardNumber'=>$billingData->cardNumber, 'errMsg'=>'*' . $e->getMessage() . ' *']);
			// return redirect('payment');
		} catch(\Cartalyst\Stripe\Exception\CardErrorException $e){
			\Session::put('error', $e->getMessage());
			return view('subscription', ['email'=>$email, 'isActive'=>$billingData->isActive, 'cardNumber'=>$billingData->cardNumber, 'errMsg'=>'*' . $e->getMessage() . ' *']);
			// return redirect('payment');
		} catch(\Cartalyst\Stripe\Exception\MissingParameterException $e){
			\Session::put('error', $e->getMessage());
			return view('subscription', ['email'=>$email, 'isActive'=>$billingData->isActive, 'cardNumber'=>$billingData->cardNumber, 'errMsg'=>'*' . $e->getMessage() . ' *']);
			// return redirect('payment');
		}
		return view('subscription', ['email'=>$email, 'errMsg'=>'']);
	}
}
