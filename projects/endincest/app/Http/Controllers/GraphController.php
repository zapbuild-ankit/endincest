<?php

namespace App\Http\Controllers;

use Facebook\Exceptions\FacebookSDKException;
use Facebook\Facebook;

class GraphController extends Controller {
	private $api;
	public function __construct(Facebook $fb) {
		$this->middleware(function ($request, $next) use ($fb) {
				$fb->setDefaultAccessToken('EAAESkbQaEmQBAC1cvHR7XF4yzMNi7P9ZAIhOvry8QILfVLSjZCIZBBqZC1l66ocZAiRt5cHZCpa3bXWfC6UKFM');

				$this->api = $fb;
			
				return $next($request);
			});
	}

	public function retrieveUserProfile() {

		try {

			$params = "first_name,last_name,age_range,gender";

			$user = $this->api->get('/me?fields='.$params)->getGraphUser();

			dd($user);

		} catch (FacebookSDKException $e) {

		}

	}
}
