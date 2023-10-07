<?php

namespace Fagfolk\Http\Controllers\Auth;

use Illuminate\Http\Request;
use Fagfolk\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Fagfolk\Company;
use Auth;
use App;

class CompanyRegisterController extends Controller
{
    //Create a new controller instance.
    public function __construct()
    {
        $this->middleware('guest:company');
    }
    public function showRegistrationForm()
    {
    	if (App::getLocale() == 'en')
    		return view('auth.register-company');
      else
      	return view('no.auth.register-company');
    }
    //Handles registration request for company
    public function register(Request $request)
    {
    	//Validates data
        $this->validator($request->all())->validate();
        //Create Company
        $company = $this->create($request->all());
        //Authenticates Company
        $this->guard()->login($company);

        //Redirects Company
	      return redirect()->intended(route('company.fillInfo'));
    }
    //Get a validator for an incoming registration request.
    protected function validator(array $data)
    {
        return Validator::make($data, [
        	'navn' 			=> 'required|alpha',
          'etternavn' 	=> 'required|alpha',
    			'mobil' 		=> 'required|min:8',
    			'email' 		=> 'required|email|unique:companies',
    			'password' 		=> 'required|min:6|confirmed',
        ]);
    }

    //Create a new user instance after a valid registration.
    protected function create(array $data)
    {
        return Company::create([
        	'navn' => $data['navn'],
          'etternavn' => $data['etternavn'],
          'mobil' => $data['mobil'],
          'email' => $data['email'],
          'password' => bcrypt($data['password']),
        ]);
    }
    /*
    //Handles registration request for company
    public function register(Request $request)
    {
    	//Validates data
        $this->validator($request->all())->validate();
        //Create Company
        $company = $this->create($request->all());
        //Authenticates Company
        $this->guard()->login($company);

        //Redirects Company
		return redirect()->intended(route('company.dashboard'));
    }

    //Get a validator for an incoming registration request.
    protected function validator(array $data)
    {
        return Validator::make($data, [
        	'name' 			=> 'required|alpha',
			'cell' 			=> 'required|min:8|numeric',
			'email' 		=> 'required|email|unique:companies',
			'password' 		=> 'required|min:6|confirmed',
        ]);
    }

    //Create a new user instance after a valid registration.
    protected function create(array $data)
    {
        return Company::create([
        	'name' => $data['name'],
            'cell' => $data['cell'],
            'email' => $data['email'],
            'password' => bcrypt($data['password']),
        ]);
    }
    */
    protected function guard()
    {
        return Auth::guard('company');
    }
}
