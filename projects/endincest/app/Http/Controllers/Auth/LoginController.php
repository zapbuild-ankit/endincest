<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Auth;
use Illuminate\Foundation\Auth\AuthenticatesUsers;

class LoginController extends Controller {
	/*
	|--------------------------------------------------------------------------
	| Login Controller
	|--------------------------------------------------------------------------
	|
	| This controller handles authenticating users for the application and
	| redirecting them to your home screen. The controller uses a trait
	| to conveniently provide its functionality to your applications.
	|
	 */

	use AuthenticatesUsers;

	/**
	 * Where to redirect users after login.
	 *
	 * @var string
	 */

	/**
	 * Create a new controller instance.
	 *
	 * @return void
	 */

	public function redirectTo() {
		if (Auth::user()->hasAnyRole('admin')) {
			return '/admin/admindash';
		} else if (Auth::user()->hasAnyRole('user')) {
			return '/user/userdash';
		}
	}

	public function __construct() {
		$this->middleware('guest')->except('logout');
	}
}
