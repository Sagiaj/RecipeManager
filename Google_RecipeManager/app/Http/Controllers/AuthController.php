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
		//$this->middleware('guest');
	}

    /**
     * Redirect the user to Google authentication page.
     * @return Response
     */
    public function redirectToProvider() {

    	return Socialite::driver('google')->redirect();

    }

    public function handleProviderCallback() {


       try{

            $user = Socialite::with('google')->user();

            //$googleUser = Socialite::driver('google')->user();
            
            //$user = $this->findOrCreateGoogleUser($googleUser);

            //auth()->login($user);

            return view('welcome')->withDetails($user)->withService('google');

       } catch(Exception $e) {

            echo $e->message();

       }
        

        return redirect('welcome');
    }

    public function findOrCreateGoogleUser($googleUser) {

        $user = User::firstOrNew(['google_id' => $googleUser->id]);

        if($user->exists) return $user;

        $user->fill([
            'name' => $googleUser->nickname,
            'email' => $googleUser->email,
            'google_id' => $googleUser->id,
            'status' => 'online'
        ])->save();

        return $user;
    }

    public function logout() {
        Auth::logout();

        return redirect('/');
    }

}
