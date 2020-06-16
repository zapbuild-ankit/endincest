<?php

use App\Role;
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

		$adminRole = Role::where('name', 'admin')->first();

		$admin = User::create(['name' => 'Admin',
				'email'                     => 'admin@gmail.com',
				'password'                  => bcrypt('admin12345')
			]);

		$admin->roles()->attach($adminRole);

	}
}
