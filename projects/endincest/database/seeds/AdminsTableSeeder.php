<?php

use App\Admin;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AdminsTableSeeder extends Seeder {
	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run() {
		Admin::truncate();

		DB::table('admins')->insert([
				[
					'name'     => "Admin",
					'email'    => 'admin@gmail.com',
					'password' => bcrypt('admin12345'), ],
				[
					'name'     => "karuna",
					'email'    => 'karuna@gmail.com',
					'password' => bcrypt('karuna12345'),
				]
			]);

	}
}
