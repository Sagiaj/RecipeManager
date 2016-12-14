<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Recipe;

class RecipeController extends Controller
{
    public function __construct() {
        $this->middleware('auth');
    }
	
    public function index($recipeID) {
    	$recipe = Recipe::find($recipeID);

    	$ingredients = $recipe->ingredients;

    	$comments = $recipe->comments;
        
    	return view('recipes.index', compact('recipe', 'ingredients', 'comments'));
    }
}
