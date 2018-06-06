<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PaymentController extends Controller
{
	public function index(Request $request){
		$email = "";
		if( $request->session()->has('LeadswamiAdmin')){
			$email = $request->session()->get('LeadswamiAdmin');
		} else{
			return redirect('/');
		}
		$billData = UserInfoController::GetBillingDatas($email);
		$billHistory = UserInfoController::GetBillHistory($email);
		return view('payment', ['email'=>$email, 'billData'=>$billData, 'billHistory'=>$billHistory]);
	}
	public function postBillingData(Request $request){
		// print_r($request->input('payCode'));
		// return;
		$email = "";
		if( $request->session()->has('LeadswamiAdmin')){
			$email = $request->session()->get('LeadswamiAdmin');
		} else{
			return redirect('/');
		}
		UserInfoController::SaveBillingDatas($request);
		return redirect('payment');
	}
	public function postPromoCode(Request $request){
		$email = "";
		if( $request->session()->has('LeadswamiAdmin')){
			$email = $request->session()->get('LeadswamiAdmin');
		} else{
			return redirect('/');
		}
		UserInfoController::SavePromoCode($email, $request);
		return redirect('payment');
	}
}
