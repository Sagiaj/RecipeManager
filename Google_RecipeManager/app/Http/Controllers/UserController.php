<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\User;

use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
	public function __construct() {
		$this->middleware('auth');
	}

    public function index() {

    	$user = User::find(Auth::user()->id);

    	$favorites = $user->favorites;

    	return view('users.index', compact('favorites'));
    }
}
