<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\User;

class UserController extends Controller
{
	public function __construct() {
		$this->middleware('auth');
	}

    public function index() {

    	$user = User::find(1);

    	$favorites = $user->favorites;

    	return view('users.index', compact('favorites'));
    }
}
