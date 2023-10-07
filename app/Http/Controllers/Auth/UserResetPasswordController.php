<?php

namespace Fagfolk\Http\Controllers\Auth;

use Fagfolk\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\ResetsPasswords;
use Illuminate\Http\Request;
use Password;
use Auth;
use App;

class UserResetPasswordController extends Controller
{
    use ResetsPasswords;

    protected $redirectTo = '/no/bruker';
    
    public function __construct()
    {
        $this->middleware('guest:privateUser');
    }
    
    protected function guard()
    {
      return Auth::guard('privateUser');
    }

    protected function broker()
    {
      return Password::broker('privateUsers');
    }

    public function showResetForm(Request $request, $token = null)
    {
    	if (App::getLocale() == 'en')
    	{
			return view('auth.passwords.reset-user')->with(
				['token' => $token, 'email' => $request->email]
			);	
		}
		else
		{
			return view('no.auth.passwords.reset-user')->with(
				['token' => $token, 'email' => $request->email]
			);  
		}
    }
}
