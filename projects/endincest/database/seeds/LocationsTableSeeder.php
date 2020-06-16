<?php

use App\Location;
use Illuminate\Database\Seeder;

class LocationsTableSeeder extends Seeder {
	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run() {
		/*$faker = Faker\Factory::create('en_IN');
		for ($i = 0; $i <= 100; $i++) {

		Location::create(['city' => $faker->city,
		'lat'                  => $faker->unique()->latitude(8.06, 37.1),
		'lng'                  => $faker->unique()->longitude(68.11, 97.41),

		]);
		}*/

		Location::create(['city' => 'Lucknow',
				'lat'                  => '26.850000',
				'lng'                  => '80.949997',

			]);

		Location::create(['city' => 'Delhi',
				'lat'                  => '28.610001',
				'lng'                  => '77.230003',

			]);
		Location::create(['city' => 'Mumbai',
				'lat'                  => '19.076090',
				'lng'                  => '	72.877426',

			]);
		Location::create(['city' => 'Raipur',
				'lat'                  => '21.250000',
				'lng'                  => '81.629997',

			]);
		Location::create(['city' => 'Patna',
				'lat'                  => '25.612677',
				'lng'                  => '85.158875',

			]);
		Location::create(['city' => 'Chandigarh',
				'lat'                  => ' 30.741482',
				'lng'                  => '76.768066',

			]);

	}

}
