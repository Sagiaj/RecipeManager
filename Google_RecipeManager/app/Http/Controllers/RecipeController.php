<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Recipe;

use App\Category;

use App\Ingredient;

class RecipeController extends Controller
{
    public function __construct() {
        $this->middleware('auth');
    }
	
    public function index($recipeID) {
    	$recipe = Recipe::find($recipeID);

    	$ingredients = $recipe->ingredients;

    	$comments = $recipe->comments;

        $users = $recipe->users;
        
    	return view('recipes.index', compact('recipe', 'ingredients', 'comments', 'users'));
    }

    /**
     * Adds a recipe according to the ORM sent in the request
     */
    public function store($categoryID, Request $request) {

        $this->validate($request, [
                'categoryId' => 'required',
                'recipeName' => 'required',
                'ingredients' => 'required',
                'description' => 'required'
            ]);
        $category = Category::find($categoryID);
        $recipe = new Recipe;


        $recipe->name = $request->recipeName;
        $recipe->description = $request->description;
        $recipe->save();

        $category->recipes()->attach($recipe);

        $ingredientsArray = explode(',', $request->ingredients);

        foreach ($ingredientsArray as $ingredient => $value) {
            if( Ingredient::all()->where('name','=',$value)->count() ){
                $ing = Ingredient::all()->where('name','=',$value)->first();
                $ing->recipes()->attach($recipe);
            } else{
                $ingredient_var =  new Ingredient;
                $ingredient_var->name = $value;
                $ing = $ingredient_var->addIngredient($ingredient_var);
                $recipe->ingredients()->attach($ing);
            }
        }

        if(isset($request->otherCategories)){
            $categoriesArray = explode(',', $request->otherCategories);

            foreach ($categoriesArray as $category => $value) {
                $categ = Category::find($value);
                if($categ!=null){
                    $categ->recipes()->attach($recipe);
                }
            }
        }

        return $recipe;
    }
}