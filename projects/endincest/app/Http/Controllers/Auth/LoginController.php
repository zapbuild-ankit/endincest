<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;

use App\SocialAccount;
use App\User;
use Auth;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Socialite;

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

	// redirecting users according to roles

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
	//Method for redirecting facebook login page

	public function redirectToFacebook() {
		return Socialite::driver('facebook')->redirect();
	}

	//Method for handling facebook callback

	public function handleFacebookCallback() {
		$provider = Socialite::driver('facebook')->user();

		$account = SocialAccount::where('provider', 'facebook')->where('provider_user_id', $provider->getId())->first();

		if ($account) {
			$user = $account->user;

		} else {
			$account = new SocialAccount([
					'provider_user_id' => $provider->getId(),
					'provider'         => 'facebook']);

			$user = User::where('email', $provider->getEmail())->first();
			if (!$user) {
				$user = User::create([
						'name'     => $provider->getName(),
						'email'    => $provider->getEmail(),
						'password' => md5(rand(1, 10000)),

					]);

			}

			$account->user()->associate($user);
			$account->save();

		}

		auth()->login($user);
		return redirect('/home');

	}

	//method for redirecting google login page

	public function redirectToGoogle() {

		return Socialite::driver('google')->redirect();
	}

	//Method for handling google  callback

	public function handleGoogleCallback() {

		$provider = Socialite::driver('google')->user();

		$account = SocialAccount::where('provider', 'google')->where('provider_user_id', $provider->getId())->first();

		if ($account) {

			$user = $account->user;

		} else {

			$account = new SocialAccount([
					'provider_user_id' => $provider->getId(),
					'provider'         => 'google']);

			$user = User::where('email', $provider->getEmail())->first();

			if (!$user) {

				$user = User::create([
						'name'     => $provider->name,
						'email'    => $provider->email,
						'password' => md5(rand(1, 10000)),
					]);
			}

			$account->user()->associate($user);
			$account->save();
		}

		Auth::login($user);

		return redirect('/home');

	}
}
