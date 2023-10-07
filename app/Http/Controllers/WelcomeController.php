<?php

namespace Fagfolk\Http\Controllers;

use Illuminate\Http\Request;

use DB;
use App;
use Auth;
use Log;


class WelcomeController extends Controller
{
  public function showSite()
  {
    $mainServices = DB::select('SELECT * FROM main_services');
    if(Auth::guard('privateUser')->check())
      $userLogged = 'costumer';
    else if(Auth::guard('company')->check())
      $userLogged = 'company';
    else
      $userLogged = 'none';

    Log::info($userLogged);
    if (App::getLocale() == 'en')
    	return view('user.velkommen', compact('mainServices', 'userLogged'));
    else
    	return view('no.velkommen', compact('mainServices', 'userLogged'));
  }

  public function sjekk_servicer($mainservice_id)
  {
		$servicer = DB::select('SELECT * FROM secondary_services WHERE mainservice_id = ?', [$mainservice_id]);
		$response = json_encode ($servicer);

		return response()->json( $response );
  }
}
