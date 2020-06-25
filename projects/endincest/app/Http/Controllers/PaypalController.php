<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Srmklive\PayPal\Services\ExpressCheckout;

class PaypalController extends Controller {

	//Method to view order page

	public function index() {
		return view('paypal.paypal');
	}
	// Method  for payment process with paypal

	public function payment(Request $request) {
		$amount = $request->validate([
				'amount' => 'required|numeric',
			]);

		$data          = [];
		$data['items'] = [
			[
				'name'  => 'endincest',
				'price' => $amount,
				'desc'  => '',
				'qty'   => 1
			]
		];

		$data['invoice_id']          = 1;
		$data['invoice_description'] = "Order #{$data['invoice_id']} Invoice";
		$data['return_url']          = route('payment.success');
		$data['cancel_url']          = route('payment.cancel');
		$data['total']               = $amount;

		$provider = new ExpressCheckout;

		$response = $provider->setExpressCheckout($data);

		$response = $provider->setExpressCheckout($data, true);

		return redirect($response['paypal_link']);
	}

	/**
	 * Responds with a welcome message with instructions
	 *
	 * @return \Illuminate\Http\Response

	 */

	//Method to cancel payment

	public function cancel() {
		return redirect('/order')->with(['success' => "Your Payment is successfully canceled"]);

	}

	/**
	 * Responds with a welcome message with instructions
	 *
	 * @return \Illuminate\Http\Response

	 */

	//Method for succcess transaction

	public function success(Request $request) {
		$response = $provider->getExpressCheckoutDetails($request->token);

		if (in_array(strtoupper($response['ACK']), ['SUCCESS', 'SUCCESSWITHWARNING'])) {

			return redirect('/order')->with(['success' => "Your Payment is successfully done"]);

		}
		return redirect('/order')->with(['success' => "Something is wrong with your paymaent"]);

	}

}
