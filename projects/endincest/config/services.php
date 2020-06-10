<?php

return [

	/*
	|--------------------------------------------------------------------------
	| Third Party Services
	|--------------------------------------------------------------------------
	|
	| This file is for storing the credentials for third party services such
	| as Mailgun, SparkPost and others. This file provides a sane default
	| location for this type of information, allowing packages to have
	| a conventional file to locate the various service credentials.
	|
	 */

	'mailgun'   => [
		'domain'   => env('MAILGUN_DOMAIN'),
		'secret'   => env('MAILGUN_SECRET'),
		'endpoint' => env('MAILGUN_ENDPOINT', 'api.mailgun.net'),
	],

	'postmark' => [
		'token'   => env('POSTMARK_TOKEN'),
	],

	'ses'     => [
		'key'    => env('AWS_ACCESS_KEY_ID'),
		'secret' => env('AWS_SECRET_ACCESS_KEY'),
		'region' => env('AWS_DEFAULT_REGION', 'us-east-1'),
	],

	'sparkpost' => [
		'secret'   => env('SPARKPOST_SECRET'),
	],

	'facebook'       => [
		'client_id'     => '301891977876068',
		'client_secret' => '764165326b4563f76ae60378bb6def34',
		'redirect'      => 'http://localhost:8000/login/facebook/callback',
	],

	'google'         => [
		'client_id'     => '943929336409-30830rn08qqb6ib2ia99u0r7g3vq1v97.apps.googleusercontent.com',
		'client_secret' => '2jz_PhOrtP4IQ0KF1_PD6WAd',
		'redirect'      => 'http://localhost:8000/auth/google/callback',
	],

];
