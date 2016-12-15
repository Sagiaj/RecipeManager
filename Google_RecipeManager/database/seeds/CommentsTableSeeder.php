<?php

class CommentsTableSeeder extends Seeder {

	public function run() {

		$faker = Faker\Factory::create();

		Comment::truncate();

		foreach(range(1, 30) as $index) {

			$userId = User::orderBy(DB::raw('RAND()'))->first()->id;

			Comment::create([
					'user_id' => $userId,
					'recipe_id' => random_int(1,30),
					'body' => $faker->paragraph(2);
				]);
		}
	}
}