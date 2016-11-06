<?php

namespace Illuminate\Foundation\Auth;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use File;

trait RegistersUsers
{
    use RedirectsUsers;

    /**
     * Show the application registration form.
     *
     * @return \Illuminate\Http\Response
     */
    public function getRegister()
    {
        return $this->showRegistrationForm();
    }
	
	private function loadJSON($filename) {
		$path = storage_path() . "/json/${filename}.json";
		if (!File::exists($path)) {
			throw new Exception("Invalid File");
		}
		return $file = File::get($path);
	}
	
	private function JSONToArray($filename) {
		$temp_countries = $this->loadJSON('countries');
		$temp_countries = str_replace(":", ",", $temp_countries);

		$countryList = explode(', ', $temp_countries);
		$how_many = count($countryList) - 2;
		for($i = 0; $i <= $how_many; $i = $i + 2){
		  $key = $countryList[$i];
		  $value = $countryList[$i+1];
		  $countries[$key] = $value;
		}
		return $countries;
	}

    /**
     * Show the application registration form.
     *
     * @return \Illuminate\Http\Response
     */
    public function showRegistrationForm()
    {
		
        if (property_exists($this, 'registerView')) {
            return view($this->registerView);
        }
        return view('auth.register')->with('countries', $this->JSONToArray('countries'));
    }

    /**
     * Handle a registration request for the application.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function postRegister(Request $request)
    {
        return $this->register($request);
    }

    /**
     * Handle a registration request for the application.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function register(Request $request)
    {
        $validator = $this->validator($request->all());

        if ($validator->fails()) {
            $this->throwValidationException(
                $request, $validator
            );
        }

        Auth::guard($this->getGuard())->login($this->create($request->all()));

        return redirect($this->redirectPath());
    }

    /**
     * Get the guard to be used during registration.
     *
     * @return string|null
     */
    protected function getGuard()
    {
        return property_exists($this, 'guard') ? $this->guard : null;
    }
}
