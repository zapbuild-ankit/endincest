<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\User;
use fpdf;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Input;
require_once ('/usr/share/php/fpdf/fpdf.php');

class ExportController extends Controller {

	// To show the data in tabular form

	public function ExportView() {
		$users = User::latest()->paginate(5);
		return view('export', compact('users'))->with('i', (request()->input('page', 1)-1)*10);
	}

	// Export data in csv format

	public function export_csv() {

		$users = User::all();
		header('Content-Type: text/csv; charset=utf-8');
		header('Content-Disposition: attachment; filename=Users.csv');
		$output = fopen('php://output', 'w');

		fputcsv($output, array('No', 'Name', 'Email', 'created_at', 'Updated_at'));

		if (!empty($users)) {
			foreach ($users as $row) {
				$userdata = array($row['id'], $row['name'], $row['email'], $row['created_at'], $row['updated_at']);
				fputcsv($output, $userdata);
			}
		}

	}

	// Export data in pdf format

	public function export_pdf() {

		$users = DB::table('users')->get();

		$header = array('id' => 'ID', 'name' => 'Name', 'email' => 'Email', 'created_at' => 'created_at');

		$pdf = new FPDF;
		;
		$pdf->AddPage('L');

		$pdf->SetFont('Arial', 'B', 12)
		;
		foreach ($header as $heading) {

			$pdf->Cell(80, 10, $heading, 1);

		}
		if (!empty($users)) {

			foreach ($users as $rowValue) {

				foreach ($rowValue as $columnValue)
				$pdf->Cell(80, 10, $columnValue, 1);

				$pdf->SetFont('Arial', '', 12);
				$pdf->Ln();
			}
			$pdf->output();

		}

	}

}