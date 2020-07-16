<?php

use App\User;

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder {
	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run() {
		User::truncate();

		$user = User::create(['name' => 'User',
				'email'                    => 'user@gmail.com',
				'password'                 => bcrypt('user12345')
			]);

	}
}
