<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Recipe;

use App\Category;

use App\Ingredient;

use App\Comment;

class RecipeController extends Controller
{
    /**
     * Checking whether the user is sessioned
     */
    public function __construct() {
        $this->middleware('auth');
    }
	
    public function index($recipeID) {
    	$recipe = Recipe::find($recipeID);

    	$ingredients = $recipe->ingredients;

    	$comments = $recipe->comments;

        $users = $recipe->users;
        
        //Should be in model
        $rootComments = $recipe->comments->where('parent_id','=',0);
        
    	return view('recipes.index', compact('recipe', 'ingredients', 'comments', 'users', 'rootComments'));
    }

    /**
     * Adds a recipe according to the ORM sent in the request
     */
    public function store($categoryID, Request $request) {
        
        //Validate given request
        $this->validate($request, [
                'categoryId' => 'required',
                'recipeName' => 'required',
                'ingredients' => 'required',
                'description' => 'required'
            ]);
        $recipe = $this->createWithCategory($categoryID, $request);

        $this->attachIngredients($request, $recipe);
        

        return $recipe;
    }

    public function createWithCategory($categoryID, Request $request) {
        $category = Category::find($categoryID);
        //Create the recipe instance and attach it to a category
        $recipe = Recipe::create([
                'name' => $request->recipeName,
                'description' => $request->description
            ]);
        $category->recipes()->attach($recipe);

        //Attaching the recipe to other categories
        if(isset($request->otherCategories)){
            $categoriesArray = explode(',', $request->otherCategories);

            //If a given category number exists => attach
            foreach ($categoriesArray as $category => $value) {
                $categ = Category::find($value);
                if($categ!=null){
                    $categ->recipes()->attach($recipe);
                }
            }
        }

        return $recipe;
    }

    public function attachIngredients(Request $request, Recipe $recipe) {
        //Arranging the ingredients input in an array
        $ingredientsArray = explode(',', $request->ingredients);

        foreach ($ingredientsArray as $ingredient => $value) {
            if( ($ing = Ingredient::all()->where('name','=',$value)->first()) ){
                $ing->recipes()->attach($recipe);
            } else{
                $ing = Ingredient::create([
                        'name' => $value
                    ]);
                $recipe->ingredients()->attach($ing);
            }
        }
    }

}