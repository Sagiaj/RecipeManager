<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Category;

class CategoryController extends Controller
{
    public function __construct() {
        $this->middleware('auth');
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
    /**
     * Store the input request to the category database
     */
    public function store(Request $request) {

        $this->validate($request, [
                'name' => 'required'
            ]);

        $category = new Category;

        $category->name = $request->name;

        $category->save();

        return $category;

    }

    public function destroy(Request $request) {
        $category = Category::find($request->id);
        return $category->deleteCategory($request, $category);
    }

}
