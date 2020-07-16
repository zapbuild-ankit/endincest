<?php

namespace App\Http\Controllers;

use App\User;
use Hash;
use Illuminate\Http\Request;
use PhpOffice\PhpSpreadsheet\Reader\Xlsx;
use Validator;

class ImportController extends Controller {

	public function __construct() {
		$this->middleware('auth:admin');
	}

	// Method to show the form to select data for import

	public function import_form() {

		return view('import.import_form');

	}

	//Method to import csv or xlsx file

	public function import_file(Request $request) {

		$validator = Validator::make($request->all(), [

				'file' => 'required',

			]);

		if ($validator    ->fails()) {
			return redirect()->back()->with('error', 'Please select csv or xlsx file');
		}

		$extension = $request->file('file')->getClientOriginalExtension();

		if (($extension == "csv") || ($extension == "xlsx")) {

			$file = $request->file('file');

			$users = User::all();

			if ($extension == "csv") {

				$csvData = file_get_contents($file);

				$rows   = array_map('str_getcsv', explode("\n", $csvData));
				$header = array_shift($rows);

				foreach ($rows as $row) {

					if ($row['0'] != '') {

						foreach ($users as $user) {

							if ($user['email'] == $row['2']) {

								return redirect()->back()->with('error', 'Some of emails already taken,please review file');
							}

						}

						User::create([

								'name'     => $row['1'],
								'email'    => $row['2'],
								'password' => Hash::make(uniqid()),

							]);

					}

				}

				return redirect()->back()->with('success', 'Data imported successfully');

			}

			if ($extension == "xlsx") {

				$Reader = new Xlsx();

				$spreadsheet = $Reader->load($file);
				$excelsheet  = $spreadsheet->getActiveSheet();
				$rows        = $excelsheet->toArray();

				foreach ($rows as $row) {

					if ($row['0'] != '') {

						foreach ($users as $user) {

							if ($user['email'] == $row['2']) {

								return redirect()->back()->with('error', 'Some of emails already taken,please review file');
							}

						}

						User::create([

								'name'     => $row['1'],
								'email'    => $row['2'],
								'password' => Hash::make(uniqid()),

							]);

					}

				}

				return redirect()->back()->with('success', 'Data imported successfully');
			}

		} else {

			return redirect()->back()->with('error', 'File type must be csv or  xlsx');
		}

	}

}
