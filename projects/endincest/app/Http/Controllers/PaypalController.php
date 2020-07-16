<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;

use Srmklive\PayPal\Services\ExpressCheckout;

class PaypalController extends Controller {

	protected $provider;
	public function __construct() {

		$this->middleware('auth:admin');

		$this->provider = new ExpressCheckout();

	}

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
				'desc'  => 'Description of endincest',
				'qty'   => 1
			]
		];
		$invoice_id = rand();

		$data['invoice_id']          = $invoice_id;
		$data['invoice_description'] = "Order #{$data['invoice_id']} Invoice";
		$data['return_url']          = route('payment.success');
		$data['cancel_url']          = route('payment.cancel');
		$data['total']               = $amount;

		//$provider = new ExpressCheckout;

		$response = $this->provider->setExpressCheckout($data);

		$response = $this->provider->setExpressCheckout($data, true);

		return redirect($response['paypal_link']);
	}

	//Method to cancel payment

	public function cancel() {

		return redirect('/order')->with(['error' => "Your Payment is successfully canceled"]);

	}

	//Method for succcess transaction

	public function success(Request $request) {
		$token = $this->provider->getExpressCheckoutDetails($request->token);

		$response = $this->provider->getExpressCheckoutDetails($request->token);

		if (in_array(strtoupper($response['ACK']), ['SUCCESS', 'SUCCESS'])) {

			return redirect('/order')->with(['success' => "Your Payment is successfully done"]);

		}
		return redirect('/order')->with(['error' => "Something is wrong with your paymaent"]);

	}

}
