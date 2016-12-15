<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Category;

class PageController extends Controller
{
    public function index() {
    	
    	$categories = Category::all();

    	return view('welcome', compact('categories'));

    }
}
