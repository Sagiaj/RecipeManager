<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\seeds\UsersTableSeeder;
use App\User;
use App\Comment;
use App\Ingredient;
use App\Category;
use App\Recipe;
class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    	Eloquent::unguard();

    	$faker = Faker\Factory::create();

		User::truncate();

		foreach(range(1, 30) as $index) {

			User::create([
					'name' => $faker->name,
					'email' => $faker->email,
					'status' => 'online',
					'google_id' => Hash::make('1234')
				]);

		}

		Comment::truncate();

		foreach(range(1, 30) as $index) {

			$userId = User::orderBy(DB::raw('RAND()'))->first()->id;

			Comment::create([
					'user_id' => $userId,
					'recipe_id' => random_int(1,30),
					'body' => $faker->paragraph(2)
				]);
		}

		Recipe::truncate();

		foreach(range(1, 30) as $index) {

			Recipe::create([
					'name' => 'recipe'.$index,
					'description' => $faker->sentence(3)
				]);
		}

		DB::table('recipe_user')->truncate();

		foreach (range(1, 30) as $index) {
			
			$recipe = Recipe::orderBy(DB::raw('RAND()'))->first();

			User::orderBy(DB::raw('RAND()'))->first()->favorites()->attach($recipe->id);

		}

		DB::table('category_recipe')->truncate();

		foreach (range(1, 30) as $index) {
			
			$recipe = Recipe::orderBy(DB::raw('RAND()'))->first();

			Category::orderBy(DB::raw('RAND()'))->first()->recipes()->attach($recipe->id);

		}

		DB::table('ingredient_recipe')->truncate();

		foreach (range(1, 30) as $index) {
			
			$ingredient = Ingredient::orderBy(DB::raw('RAND()'))->first();

			Recipe::orderBy(DB::raw('RAND()'))->first()->ingredients()->attach($ingredient->id);

		}

        //$this->call('UsersTableSeeder');
        //$this->call('CommentsTableSeeder');
    }
}
