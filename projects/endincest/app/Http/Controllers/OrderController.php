<?php

namespace App\Http\Controllers;

use App\Paytm;
use Illuminate\Http\Request;
use PaytmWallet;

class OrderController extends Controller {

	public function __construct() {
		$this->middleware('auth:admin');
	}

	//Method to show register form

	public function register() {
		return view('paytm.paytm_payment_form');
	}

	/**
	 * Redirect the user to the Payment Gateway.
	 *
	 * @return Response
	 */
	public function order(Request $request) {

		$this->validate($request, [
				'name'      => 'required',
				'mobile_no' => 'required|numeric|digits:10|unique:paytms,mobile_no',
				'desc'      => 'required',
			]);

		$input             = $request->all();
		$input['order_id'] = $request->mobile_no.rand(1, 100);
		$input['fee']      = 50;
		$input['token']    = $request->_token;

		Paytm::create($input);

		$payment = PaytmWallet::with('receive');

		$payment->prepare([
				'order'         => $input['order_id'],
				'user'          => rand(1, 200),
				'mobile_number' => '6203009772',
				'email'         => "fbg.ankit@gmail.com",
				'amount'        => $input['fee'],
				'callback_url'  => url('api/payment/status'),

			]);

		return $payment->receive();
	}

	/**
	 * Obtain the payment information.
	 *
	 * @return Object
	 */
	public function paymentCallback() {

		$transaction = PaytmWallet::with('receive');

		$response = $transaction->response();

		$order_id = $transaction->getOrderId();

		if ($transaction                    ->isSuccessful()) {
			Paytm::where('order_id', $order_id)->update(['status' => 2, 'transaction_id' => $transaction->getTransactionId()]);

			return Redirect('event_registration')->with('success', 'Paytm payment is success');
		} else if ($transaction             ->isFailed()) {
			Paytm::where('order_id', $order_id)->update(['status' => 1, 'transaction_id' => $transaction->getTransactionId()]);
			return Redirect('event_registration')->with('error', 'Paytm payment is failed');
		}
	}
}