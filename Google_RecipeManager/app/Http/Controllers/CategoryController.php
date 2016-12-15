<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Category;

class CategoryController extends Controller
{
    public function __construct() {
        //$this->middleware('auth');
    }
	/*
	 * Return a view loaded with the category's details.
	 * @return categories.index view
	 */
    public function index($categoryID) {
    	$category = Category::find($categoryID);
    	$recipes = $category->recipes;
    	
    	return view('categories.index', compact('recipes','category'));
    }

}
