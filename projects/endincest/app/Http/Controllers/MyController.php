<?php

namespace App\Http\Controllers;

use App\Exports\UsersExport;
use App\Imports\UsersImport;
use App\User;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class MyController extends Controller {

	public function __construct() {
		$this->middleware('auth:admin');
	}
	/**
	 * @return \Illuminate\Support\Collection
	 */
	public function ExportView() {
		return view('export')->with('users', User::all());
	}

	/**
	 * @return \Illuminate\Support\Collection
	 */
	public function export() {
		return Excel::download(new UsersExport, 'users.xlsx');
	}

	/**
	 * @return \Illuminate\Support\Collection
	 */
	public function import() {
		Excel::import(new UsersImport, request()->file('file'));

		return back();
	}
}