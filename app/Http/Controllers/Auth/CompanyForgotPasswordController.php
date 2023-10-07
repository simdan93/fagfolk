<?php

namespace Fagfolk\Http\Controllers\Auth;

use Fagfolk\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\SendsPasswordResetEmails;
use Password;
use App;

class CompanyForgotPasswordController extends Controller
{
    use SendsPasswordResetEmails;
    
    public function __construct()
    {
        $this->middleware('guest:company');
    }
    protected function broker()
    {
    	return Password::broker('companies');
    }

    public function showLinkRequestForm()
    {
    	if (App::getLocale() == 'en')
    		return view('auth.passwords.email-company');
		else
        	return view('no.auth.passwords.email-company');
    }
}
