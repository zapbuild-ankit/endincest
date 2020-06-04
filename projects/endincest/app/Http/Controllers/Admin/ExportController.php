<?php

namespace App\Http\Controllers\Admin;

use App\Exports\UsersExport;
use App\Http\Controllers\Controller;
use App\User;
use Excel;
use Illuminate\Http\Request;
use Input;

class ExportController extends Controller {

	// To show the data in tabular form

	public function ExportView() {
		$users = User::latest()->paginate(5);
		return view('export', compact('users'))->with('i', (request()->input('page', 1)-1)*10);
	}

	// Export data in csv format

	public function export() {
		return Excel::download(new UsersExport, 'users.xlsx');
	}

	// Export data in pdf format

	public function export_pdf() {

		return Excel::download(new UsersExport, 'users.pdf');

	}

}