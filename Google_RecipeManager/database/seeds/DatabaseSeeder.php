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
					'password' => 'pass',
					'google_id' => Hash::make('1234')
				]);

		}

		Category::truncate();

		foreach(range(1,10) as $index){
			Category::create([
					'name' => 'category'.$index
				]);
		}



		Recipe::truncate();

		foreach(range(1, 30) as $index) {

			Recipe::create([
					'name' => 'recipe'.$index,
					'description' => $faker->sentence(3)
				]);
		}

		Comment::truncate();

				foreach(range(1, 1000) as $index) {

					$userId = User::orderBy(DB::raw('RAND()'))->first()->id;

					$recipeId = random_int(1, 30);
					$parentId=0;
					$recipe = Recipe::find($recipeId);
					if(isset($recipe)){
						if($recipe->comments()->count()){
							$parentId = DB::table('comments')->where('recipe_id','=',$recipeId)->where('parent_id','=','0')->orderBy(DB::raw('RAND()'))->first()->id;
						}
					}

					Comment::create([
							'parent_id' => $index>300 ? $parentId : 0,
							'user_id' => $userId,
							'recipe_id' => isset($recipe) ? $recipeId : random_int(1, 30),
							'body' => $faker->paragraph(2)
						]);
				}
		Ingredient::truncate();

		foreach (range(1,30) as $index) {
			Ingredient::create([
					'name' => 'ingredient'.$index
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
