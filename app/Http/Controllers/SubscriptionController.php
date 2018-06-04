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
	public function index(Request $request){
		$email = "";
		if( $request->session()->has('LeadswamiAdmin')){
			$email = $request->session()->get('LeadswamiAdmin');
		} else{
			return redirect('/');
		}
		$billingData = UserInfoController::GetBillingDatas($email);
		$expDate = strtotime($billingData->ExpirationDate);
		$nextDate = strtotime('+1 days');
		if( $expDate > $nextDate){
			$isActive = 1;
		} else{
			$isActive = 0;
		}
		return view('subscription', ['email'=>$email, 'isActive'=>$isActive]);
	}
	public function postPlan(Request $request){
		$email = "";
		if( $request->session()->has('LeadswamiAdmin')){
			$email = $request->session()->get('LeadswamiAdmin');
		} else{
			return redirect('/');
		}
		$cardNumber = UserInfoController::GetCardNumber($email);
		if( $cardNumber == ""){
			return redirect('/payment');
		}
		$status = $request->input('status');
		$stripe = Stripe::make('sk_test_Zcxay4Kz2nO0FISBUH89Bzc8');

		$billingData = UserInfoController::GetBillingDatas($email);
		$curExpDate = strtotime($billingData->ExpirationDate);
		$curDate = strtotime(date('Y-m-d'));
		if( $status == 1){
			$date = strtotime('+1 years', $curExpDate == "" ? $curDate : $curExpDate );
			$amount = 29;
		} else{
			if( date('d') == 31 || (date('m') == 1 && date('d') > 28)){
				$date = strtotime('last day of next month', $curExpDate == "" ? $curDate : $curExpDate);
			} else {
				$date = strtotime('+1 months', $curExpDate == "" ? $curDate : $curExpDate);
			}
			$amount = 2.5;
		}
		$expiration = date('Y-m-d', $date);
		try{
			$token = $stripe->tokens()->create([
				'card' => [
					'number' => $cardNumber,
					'exp_month' => date('m', $date),
					'exp_year' => date('Y', $date),
					'cvc' => '311',
				],
			]);
			if(!isset($token['id'])){
				return redirect('/payment');
			}
			if( $status == 1){
				$charge = $stripe->charges()->create([
					'card' => $token['id'],
					'currency' => 'USD',
					'amount' => 29,
					'description' => 'Add in wallet',
				]);
			} else{
				$charge = $stripe->charges()->create([
					'card' => $token['id'],
					'currency' => 'USD',
					'amount' => $amount,
					'description' => 'Add in wallet',
				]);
			}

			if($charge['status'] == 'succeeded'){
				// Write Here your Database insert logic.
				UserInfoController::updateExpirationDate($email, $expiration);
				UserInfoController::updateBillingData($email, 'Add in wallet', $amount, $expiration);
				return redirect('/subscription');
			} else{
				\Session::put('error', 'Money not add in wallet!!');
				return redirect('/payment');
			}
		} catch(Exception $e){
			\Session::put('error', $e->getMessage());
			return redirect('payment');
		} catch(\Cartalyst\Stripe\Exception\CardErrorException $e){
			\Session::put('error', $e->getMessage());
			return redirect('payment');
		} catch(\Cartalyst\Stripe\Exception\MissingParameterException $e){
			\Session::put('error', $e->getMessage());
			return redirect('payment');
		}
		return view('subscription', ['email'=>$email]);
	}
}
