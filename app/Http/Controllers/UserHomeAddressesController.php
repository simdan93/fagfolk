<?php

namespace Fagfolk\Http\Controllers;

use Illuminate\Http\Request;
use Fagfolk\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

use Fagfolk\UserHomeAddress;
use Auth;
use DB;
use App;

class UserHomeAddressesController extends Controller
{
    //Create a new controller instance.
    public function __construct()
    {
        $this->middleware('auth:privateUser');
    }

    public function showUpdateForm()
    {
    	$userID = Auth::user()->id;
    	$sql = "SELECT pha.id, pha.addresse, pha.postnummer, pha.sted
    			FROM user_home_addresses pha, users u
    			WHERE u.id = pha.user_id AND u.id = ?";
    	$homeAddress = DB::select($sql,[$userID]);
    	if (App::getLocale() == 'en')
    		return view( 'user.details.update-home-address', ['homeAddress' => $homeAddress] );
		else
        	return view( 'no.user.details.update-home-address', ['homeAddress' => $homeAddress] );
    }

    public function updateDetails(Request $request)
    {
      $userID = Auth::user()->id;
    	$input = $request->all();
    	$this->validator($input)->validate();
    	//Validates data
    	$homeAddress = $request->input('addresse');
    	$homePostNr = $request->input('postnummer');
    	$homeLocation = $request->input('sted');

		DB::update('UPDATE user_home_addresses SET addresse = ? WHERE user_id = ?',[$homeAddress, $userID]);
		DB::update('UPDATE user_home_addresses SET postnummer = ? WHERE user_id = ?',[$homePostNr, $userID]);
		DB::update('UPDATE user_home_addresses SET sted = ? WHERE user_id = ?',[$homeLocation, $userID]);

		//Redirects to dashboard
		if (App::getLocale() == 'en')
			return redirect()->intended(route('user.details'))->with('detailsUpdated', 'Home address updated!');
		else
        	return redirect()->intended(route('user.details'))->with('detailsUpdated', 'Hjemmeaddresse oppdatert!');
    }

    protected function validator(array $data)
    {
         return Validator::make($data, [
        	'addresse' 		=> 'required|string',
			'postnummer'	=> 'required|string',
			'sted' 			=> 'required|string',
        ]);
    }
}
