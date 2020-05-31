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
		$userRole  = Role::where('name', 'user')->first();

		$admin = User::create(['name' => 'Admin',
				'email'                     => 'fbg.ankit@gmail.com',
				'password'                  => bcrypt('admin12345')
			]);

		$user = User::create(['name' => 'User',
				'email'                    => 'user@user.com',
				'password'                 => bcrypt('user')
			]);
		$admin->roles()->attach($adminRole);
		$user->roles()->attach($userRole);

	}
}
