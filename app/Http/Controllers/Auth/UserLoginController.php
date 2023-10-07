<?php

namespace Fagfolk\Http\Controllers\Auth;

use Fagfolk\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\MessageBag;
use Auth;
use App;

class UserLoginController extends Controller
{
	public function __construct()
	{
		$this->middleware('guest:privateUser')->except('logout');
	}

    public function showLoginForm()
    {
    	if (App::getLocale() == 'en')
    		return view('auth.user-login');
		else
        	return view('no.auth.user-login');
    }

    public function login(Request $request)
    {
		// Validate the form data
		$this->validate($request, [
			'email'   => 'bail|required|email',
			'password' => 'required'
		]);

		// Attempt to log the user in
		if (Auth::guard('privateUser')->attempt(['email' => $request->email, 'password' => $request->password], $request->remember)) {
			// if successful, then redirect to their intended location
			return redirect()->intended(route('user.dashboard'));
		}
		else {
			$errors = new MessageBag(['error_password_private' => ['Email og/eller passord er feil']]);
			// if unsuccessful, then redirect back to the login with the form data
			return redirect()->back()->withErrors($errors)->withInput($request->only('email', 'remember'));
		}


    }

		public function login2(Request $request)
    {
			// Validate the form data
			$this->validate($request, [
				'email'   => 'bail|required|email',
				'password' => 'required|min:6',
				'secServiceID' => 'required',
			]);

			// Attempt to log the user in
			if (Auth::guard('privateUser')->attempt(['email' => $request->email, 'password' => $request->password], $request->remember)) {
				// if successful, then redirect to their intended location
				return redirect()->action('FindHelpController@showRegisterForm2', ['secServiceID' => $request->secServiceID]);
			}

			$errors = new MessageBag(['password' => ['Email og/eller passord er feil']]);
			// if unsuccessful, then redirect back to the login with the form data
			return redirect()->back()->withErrors($errors)->withInput($request->only('email', 'remember'));
    }
		public function login3(Request $request)
    {
			// Validate the form data
			$this->validate($request, [
				'email'   => 'bail|required|email',
				'password' => 'required|min:6',
				'mainServiceID' => 'required',
			]);

			// Attempt to log the user in
			if (Auth::guard('privateUser')->attempt(['email' => $request->email, 'password' => $request->password], $request->remember)) {
				// if successful, then redirect to their intended location
				return redirect()->action('FindHelpController@showRegisterForm3', ['mainServiceID' => $request->mainServiceID]);
			}

			$errors = new MessageBag(['password' => ['Email og/eller passord er feil']]);
			// if unsuccessful, then redirect back to the login with the form data
			return redirect()->back()->withErrors($errors)->withInput($request->only('email', 'remember'));
    }

    public function logout()
    {
        Auth::guard('privateUser')->logout();
        return redirect()->intended(route('welcome'));
    }
}
