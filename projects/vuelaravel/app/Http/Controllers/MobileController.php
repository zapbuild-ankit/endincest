<?php

namespace App\Http\Controllers;

use App\Mobile;
use Illuminate\Http\Request;

class MobileController extends Controller {
	/**
	 * Display a listing of the resource.
	 *
	 * @return IlluminateHttpResponse
	 */
	public function index() {
		$mobiles = Mobile::get();
		return response()->json([
				'mobiles' => $mobiles,
			], 200);
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return IlluminateHttpResponse
	 */
	public function create() {
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @param  IlluminateHttpRequest  $request
	 * @return IlluminateHttpResponse
	 */
	public function store(Request $request) {
		$this->validate($request, [
				'title'             => 'required|max:255',
				'mobileinformation' => 'required',
			]);

		$mobile = Mobile::create([
				'title'             => request('title'),
				'mobileinformation' => request('mobileinformation'),
			]);

		return response()->json([
				'mobile'  => $mobile,
				'message' => 'Success'
			], 200);
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  AppMobile  $mobile
	 * @return IlluminateHttpResponse
	 */
	public function show(Mobile $mobile) {
		//
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  AppMobile  $mobile
	 * @return IlluminateHttpResponse
	 */
	public function edit(Mobile $mobile) {
		//
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  IlluminateHttpRequest  $request
	 * @param  AppMobile  $mobile
	 * @return IlluminateHttpResponse
	 */
	public function update(Request $request, Mobile $mobile) {
		$this->validate($request, [
				'title'             => 'required|max:255',
				'mobileinformation' => 'required',
			]);

		$mobile->title             = request('title');
		$mobile->mobileinformation = request('mobileinformation');
		$mobile->save();

		return response()->json([
				'message' => 'Mobile updated successfully!'
			], 200);
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  AppMobile  $mobile
	 * @return IlluminateHttpResponse
	 */
	public function destroy(Mobile $mobile) {
		//
	}
}