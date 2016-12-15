<?php

class UsersTableSeeder extends Seeder {

	public function run() {

		$faker = Faker\Factory::create();

		User::truncate();

		foreach(range(1, 30) as $index) {

			User::create([
					'name' => $faker->name,
					'email' => $faker->email,
					'google_id' => Hash::make('1234');
				]);

		}

	}

}