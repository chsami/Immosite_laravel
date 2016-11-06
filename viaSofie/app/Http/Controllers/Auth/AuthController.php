<?php

namespace App\Http\Controllers\Auth;

use App\User;
use Validator;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\ThrottlesLogins;
use Illuminate\Foundation\Auth\AuthenticatesAndRegistersUsers;
use Socialite;
use Auth;

class AuthController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Registration & Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users, as well as the
    | authentication of existing users. By default, this controller uses
    | a simple trait to add these behaviors. Why don't you explore it?
    |
    */

    use AuthenticatesAndRegistersUsers, ThrottlesLogins;

    /**
     * Where to redirect users after login / registration.
     *
     * @var string
     */
    protected $redirectTo = '/';

    /**
     * Create a new authentication controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest', ['except' => 'logout']);
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'email' 		=> 		'required|email|max:255|unique:users',
			'username'		=>		'required|String|min:6|max:25|unique:users',
            'password' 		=> 		'required|confirmed|min:6|max:60',
			/*'firstname'		=> 		'required|alpha|min:2|max:25',
			'lastname'		=>		'required|String|min:2|max:25',
			'country'		=>		'required|alpha|min:2|max:60',
			'zipcode'		=>		'required|alpha_num|min:2|max:8',
			'region'		=>		'required|alpha|min:2|max:30',
			'city'			=>		'required|alpha|min:2||max:30',
			'street'		=>		'required|String|min:2|max:60',
			'street_number'	=>		'required|Integer|digits_between:1,5',
			'mailbox'		=>		'alpha_num|max:5',
			'cellphone'		=>		'required|String|max:60',*/
			'salutation'	=>		'required',
			//'g_recaptcha_response' => 'required|captcha',
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return User
     */
    protected function create(array $data)
    {
        return User::create([
            'username' => $data['username'],
            'email' => $data['email'],
			/*'firstname' => $data['firstname'],
			'lastname' => $data['lastname'],
			'country' => $data['country'],
			'zipcode' => $data['zipcode'],
			'region' => $data['region'],
			'city' => $data['city'],
			'street' => $data['street'],
			'street_number' => $data['street_number'],
			'mailbox' => $data['mailbox'],
			'cellphone' => $data['cellphone'],*/
			'salutation' => $data['salutation'],
            'password' => bcrypt($data['password']),
        ]);
    }
	
	/**
     * Redirect the user to the Facebook authentication page.
     *
     * @return Response
     */
    public function redirectToProvider()
    {
		
        return Socialite::driver('facebook')->redirect();
    }

     /**
     * Obtain the user information from Facebook.
     *
     * @return Response
     */
    public function handleProviderCallback()
    {
        try {
            $user = Socialite::driver('facebook')->user();
        } catch (Exception $e) {
            return redirect('auth/facebook');
        }
		
        $authUser = $this->findOrCreateUser($user);
 
        Auth::login($authUser, true);
		
        return redirect()->route('home');
    }
 
    /**
     * Return user if exists; create and return if doesn't
     *
     * @param $facebookUser
     * @return User
     */
    private function findOrCreateUser($facebookUser)
    {
        $authUser = User::where('email', $facebookUser->email)->first();
 
        if ($authUser) {
            return $authUser;
        }
 
        return User::create([
            'username' => $facebookUser->name,
            'email' => $facebookUser->email
        ]);
    }
}
