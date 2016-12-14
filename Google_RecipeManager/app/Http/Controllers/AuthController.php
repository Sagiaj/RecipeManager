<?php

namespace App\Http\Controllers\Auth;
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Auth;
use App\User;
use Socialite;

class AuthController extends Controller
{
	public function __construct() {
		$this->middleware('guest');
	}

    /**
     * Redirect the user to Google authentication page.
     * @return Response
     */
    public function redirectToProvider() {

    	return Socialite::driver('google')->redirect();

    }

    public function handleProviderCallback() {

        $google_user = Socialite::driver('google')->user();
        
        $data = [
            'google_id' => $google_user->getId(),
            'email' => $google_user->getEmail(),
            'name' => $google_user->getName(),
            'password' => 'Google',
            'status' => 'online'
        ];
        
        Auth::login(User::firstOrCreate($data));

        return redirect()->to('welcome')->with($google_user);
    }

}
