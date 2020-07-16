<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\SocialAccount;
use App\User;
use Auth;

use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
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

	protected $redirectTo = '/home';

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
		return redirect('/home')->with('user', $user);

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

	public function googleLogin(Request $request) {
		$google_redirect_url = route('glogin');
		$gClient             = new \Google_Client();
		$gClient->setApplicationName(config('services.google.app_name'));
		$gClient->setClientId(config('services.google.client_id'));
		$gClient->setClientSecret(config('services.google.client_secret'));
		$gClient->setRedirectUri($google_redirect_url);
		$gClient->setDeveloperKey(config('services.google.api_key'));
		$gClient->setScopes(array(
				'https://www.googleapis.com/auth/plus.me',
				'https://www.googleapis.com/auth/userinfo.email',
				'https://www.googleapis.com/auth/userinfo.profile',
			));
		$google_oauthV2 = new \Google_Service_Oauth2($gClient);
		if ($request->get('code')) {
			$gClient->authenticate($request->get('code'));
			$request->session()->put('token', $gClient->getAccessToken());
		}
		if ($request->session()->get('token')) {
			$gClient->setAccessToken($request->session()->get('token'));
		}
		if ($gClient->getAccessToken()) {
			//For logged in user, get details from google using access token
			$guser = $google_oauthV2->userinfo->get();

			$request->session()->put('name', $guser['name']);
			if ($user = User::where('email', $guser['email'])->first()) {
				//logged your user via auth login
				Auth::login($user);

				return redirect('/home');

			} else {
				//register your user with response data

				$user = User::create([
						'name'     => $guser->name,
						'email'    => $guser->email,
						'password' => md5(rand(1, 10000)),
					]);

				Auth::login($user);

				return redirect('/home');

			}

		} else {
			//For Guest user, get google login url
			$authUrl = $gClient->createAuthUrl();
			return redirect()->to($authUrl);
		}
	}

}
