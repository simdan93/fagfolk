<?php

namespace Fagfolk\Http\Controllers\Auth;

use Fagfolk\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\ResetsPasswords;
use Illuminate\Http\Request;
use Password;
use Auth;
use App;

class CompanyResetPasswordController extends Controller
{
    use ResetsPasswords;

    protected $redirectTo = '/no/selskap';
    
    public function __construct()
    {
        $this->middleware('guest:company');
    }
    
    protected function guard()
    {
    	return Auth::guard('company');
    }

    protected function broker()
    {
    	return Password::broker('companies');
    }

    public function showResetForm(Request $request, $token = null)
    {
    	if (App::getLocale() == 'en')
    	{
    		return view('auth.passwords.reset-company')->with(
				['token' => $token, 'email' => $request->email]
			);		
		}
        else
        {
        	return view('no.auth.passwords.reset-company')->with(
        		['token' => $token, 'email' => $request->email]
            );  
        }
    }
}
