<?php

namespace App\Http\Controllers;

use App\Coupon;

use Illuminate\Http\Request;

class CouponController extends Controller {

	public function __construct() {
		$this->middleware('auth:admin');

	}

	/**
	 * Display a listing of the resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function index() {
		$coupons = Coupon::all();
		return view('coupons.index', compact('coupons'));

	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function create() {
		return view('coupons.create');
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @return \Illuminate\Http\Response
	 */
	public function store(Request $request) {

		$validatedData = $request->validate([
				'type' => 'required',

			]);

		$coupon = new Coupon;
		$chars  = "0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ";
		$code   = "";
		for ($i = 0; $i < 6; $i++) {
			$code .= $chars[mt_rand(0, strlen($chars)-1)];
		}

		$coupon->code        = $code;
		$coupon->type        = $request->type;
		$coupon->value       = $request->value;
		$coupon->percent_off = $request->percent_off;
		$coupon->save();

		return redirect('coupons')->with('success', 'Coupon is successfully saved');
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  \App\product  $product
	 * @return \Illuminate\Http\Response
	 */
	public function edit($id) {
		$coupon = Coupon::findOrFail($id);

		return view('coupons.edit')->with('coupon', $coupon);
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @param  \App\product  $product
	 * @return \Illuminate\Http\Response
	 */
	public function update(Request $request, $id) {
		$coupon = Coupon::findOrFail($id);

		$this->validate($request, ['type' => 'required', 'value' => 'required', 'percent_off' => 'required']);

		$input = $request->only('type', 'value', 'percent_off');

		$coupon->update($input);
		return redirect('coupons')->with('success', 'Coupon is successfully edited');

	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  \App\product  $product
	 * @return \Illuminate\Http\Response
	 */
	public function destroy($id) {
		$coupon = Coupon::findOrFail($id);

		$coupon->delete();
		session()->forget('coupon');

		return redirect()->back()->with('success', 'Coupon is successfully deleted');

	}

}