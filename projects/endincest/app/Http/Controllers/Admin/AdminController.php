<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

class AdminController extends Controller {
	public function admindash() {
		return view('admin.admindash');
	}
}
