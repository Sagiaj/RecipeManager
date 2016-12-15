<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\User;

use App\Recipe;

class FavoriteController extends Controller
{
    public function store(Request $request) {


    	$userId = $request->user_id;

    	$user = User::find($userId);

    	$recipe = Recipe::find($request->recipe_id);

    	$user->favorites()->attach($recipe);

    	return redirect()->back();

    }

    public function destroy(Request $request) {
    	$user = User::find($request->user_id);
    	$favorite = Recipe::find($request->recipe_id);

    	if($favorite){
    		$user->favorites()->detach($favorite);
    	}
    	
    	return redirect()->back();
    }
}
