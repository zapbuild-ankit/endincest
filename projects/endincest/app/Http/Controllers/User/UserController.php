<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;

class UserController extends Controller {
	public function userdash() {
		return view('user.userdash');
	}

}
