<?php

namespace Fagfolk\Http\Controllers;

use Illuminate\Http\Request;
use Fagfolk\Http\Controllers\Controller;                 
use App;

class ChangeLanguageController extends Controller
{    
    public function changeToEn()
    {
    	App::setLocale('en');
    	return redirect()->intended(route('welcome'));
    }
    
    public function changeToNo()       
    {
    	App::setLocale('no');
    	return redirect()->intended(route('velkommen'));
    }
}
