<?php

namespace Fagfolk\Http\Controllers\Auth;

use Illuminate\Http\Request;
use Fagfolk\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Fagfolk\User;
use Auth;
use App;

class UserRegisterController extends Controller
{
    public function __construct()
    {
        $this->middleware('guest:privateUser');
    }
    public function showRegistrationForm()
    {
    	if (App::getLocale() == 'en')
    		return view('auth.register-user');
		else
        	return view('no.auth.register-user');
    }

    //Handles registration request for user
    public function register(Request $request)
    {
       //Validates data
        $this->validator($request->all())->validate();
       //Create user
        $user = $this->create($request->all());
        //Authenticates user
        $this->guard()->login($user);
		    //Redirects user
	      return redirect()->intended(route('user.register-addresses'));
    }

    protected function validator(array $data)
    {
        return Validator::make($data, [
        	'navn' 			=> 'required|alpha',
    			'etternavn' 	=> 'required|alpha',
    			'alder' 		=> 'nullable|numeric',
    			'telefon' 		=> 'nullable|numeric|min:8',
    			'mobil' 		=> 'required|min:8',
    			'email' 		=> 'required|email|unique:users',
    			'password' 		=> 'required|min:6|confirmed',
        ]);
    }

    protected function create(array $data)
    {
        return User::create([
            'navn' 		=> $data['navn'],
            'etternavn' => $data['etternavn'],
            'alder' 	=> $data['alder'],
            'telefon' 	=> $data['telefon'],
            'mobil' 	=> $data['mobil'],
            'email' 	=> $data['email'],
            'password' 	=> bcrypt($data['password']),
        ]);
    }

    protected function guard()
    {
        return Auth::guard('privateUser');
    }
}
