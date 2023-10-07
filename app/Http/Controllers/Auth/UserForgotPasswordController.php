<?php

namespace Fagfolk\Http\Controllers\Auth;

use Fagfolk\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\SendsPasswordResetEmails;
use Password;
use App;

class UserForgotPasswordController extends Controller
{
    use SendsPasswordResetEmails;
    
    public function __construct()
    {
        $this->middleware('guest:privateUser');
    }
    
    protected function broker()
    {
      return Password::broker('privateUsers');
    }

    public function showLinkRequestForm()
    {
    	if (App::getLocale() == 'en')
    		return view('auth.passwords.email-user');
		else
        	return view('no.auth.passwords.email-user');
        
    }
}
