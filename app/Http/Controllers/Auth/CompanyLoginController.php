<?php

namespace Fagfolk\Http\Controllers\Auth;

use Fagfolk\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\MessageBag;
use Auth;
use App;
use Log;

class CompanyLoginController extends Controller
{
	public function __construct()
	{
		$this->middleware('guest:company')->except('logout');
	}

  public function showLoginForm()
  {
  	if (App::getLocale() == 'en')
  		return view('auth.company-login');
		else
    	return view('no.auth.company-login');
  }

  public function login(Request $request)
  {
		// Validate the form data
		$this->validate($request, [
			'email'   => 'bail|required|email',
			'password' => 'required|min:6'
		]);

		// Attempt to log the user in
		if (Auth::guard('company')->attempt(['email' => $request->email, 'password' => $request->password], $request->remember)) {
			// if successful, then redirect to their intended location
			return redirect()->intended(route('company.dashboard'));
		}
		else {
			// if unsuccessful, then redirect back to the login with the form data and errormessage
			$errors = new MessageBag(['error_password_company' => ['Email og/eller passord er feil']]);
			return redirect()->back()->withErrors($errors)->withInput($request->only('email', 'remember'));
		}
  }

	public function login2(Request $request)
  {
		// Validate the form data
		$this->validate($request, [
			'email'   => 'bail|required|email',
			'password' => 'required|min:6',
			'secServiceIDCompany' => 'required',
		]);

		// Attempt to log the user in
		if (Auth::guard('company')->attempt(['email' => $request->email, 'password' => $request->password], $request->remember)) {
			// if successful, then redirect to their intended location
			return redirect()->action('FindHelpCompanyController@showRegisterForm2', ['secServiceIDCompany' => $request->secServiceIDCompany]);
		}

		// if unsuccessful, then redirect back to the login with the form data and errormessage
		$errors = new MessageBag(['password' => ['Email og/eller passord er feil']]);
		return redirect()->back()->withErrors($errors)->withInput($request->only('email', 'remember'));
  }

	public function login3(Request $request)
  {
		// Validate the form data
		$this->validate($request, [
			'email'   => 'bail|required|email',
			'password' => 'required|min:6',
			'mainServiceIDCompany' => 'required',
		]);

		// Attempt to log the user in
		if (Auth::guard('company')->attempt(['email' => $request->email, 'password' => $request->password], $request->remember)) {
			// if successful, then redirect to their intended location
			return redirect()->action('FindHelpCompanyController@showRegisterForm3', ['mainServiceIDCompany' => $request->mainServiceIDCompany]);
		}

		// if unsuccessful, then redirect back to the login with the form data and errormessage
		$errors = new MessageBag(['password' => ['Email og/eller passord er feil']]);
		return redirect()->back()->withErrors($errors)->withInput($request->only('email', 'remember'));
  }

  public function logout()
  {
    Auth::guard('company')->logout();
    return redirect()->intended(route('welcome'));
  }
}
