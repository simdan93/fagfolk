<?php

namespace Fagfolk\Http\Controllers;

use Illuminate\Http\Request;
use Fagfolk\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

//use Fagfolk\CompanyDetails;
use Auth;
use DB;
use App;

class UserDetailsController extends Controller
{
    //Create a new controller instance.
    public function __construct()
    {
        $this->middleware('auth:privateUser');
    }

    public function showUserInfo()
    {
    	$userID = Auth::user()->id;

    	$userDetails = DB::select('SELECT * FROM users WHERE id = ?',[$userID]);

    	$sqlHA = "SELECT pha.addresse, pha.postnummer, pha.sted
    			FROM user_home_addresses pha, users u
    			WHERE u.id = pha.user_id AND u.id = ?";
    	$homeAddress = DB::select($sqlHA,[$userID]);

    	$sqlPA = "SELECT ppa.faktura_addresse, ppa.faktura_postnummer, ppa.faktura_by
    			FROM user_pay_addresses ppa, users u
    			WHERE u.id = ppa.user_id AND u.id = ?";
    	$payAddress = DB::select($sqlPA,[$userID]);

    	if (App::getLocale() == 'en')
    		return view( 'user.details.show-details', compact('userDetails', 'homeAddress', 'payAddress'));
    	else
        if ($homeAddress == null or $payAddress == null){
          return view( 'no.user.details.show-details_', compact('userDetails'));
        }
        else {
          return view( 'no.user.details.show-details', compact('userDetails', 'homeAddress', 'payAddress'));
        }
      }

    public function showUpdateForm()
    {
    	$userID = Auth::user()->id;
    	$userDetails = DB::select('select * from users where id = ?',[$userID]);

    	if (App::getLocale() == 'en')
    		return view( 'user.details.update-details', ['userDetails'=> $userDetails] );
    	else
    		return view( 'no.user.details.update-details', ['userDetails'=> $userDetails] );
    }

    public function updateDetails(Request $request)
    {
      $userID = Auth::user()->id;
    	$input = $request->all();
    	$this->validateUpdates($input)->validate();
    	//Validates data
    	$navn = $request->input('navn');
    	$etternavn = $request->input('etternavn');
    	$age = $request->input('alder');
    	$phone = $request->input('telefon');
    	$cell = $request->input('mobil');

		DB::update('UPDATE users SET navn = ? WHERE id = ?',[$navn, $userID]);
		DB::update('UPDATE users SET etternavn = ? WHERE id = ?',[$etternavn, $userID]);
		DB::update('UPDATE users SET alder = ? WHERE id = ?',[$age, $userID]);
		DB::update('UPDATE users SET telefon = ? WHERE id = ?',[$phone, $userID]);
		DB::update('UPDATE users SET mobil = ? WHERE id = ?',[$cell, $userID]);

		//Redirects to dashboard
		if (App::getLocale() == 'en')
			return redirect()->intended(route('user.details'))->with('detailsUpdated', 'Details updated!');
		else
			return redirect()->intended(route('user.details'))->with('detailsUpdated', 'Detaljer oppdatert!');
    }

    protected function validateUpdates(array $data)
    {
      return Validator::make($data, [
        'navn' 			=> 'required|alpha',
        'etternavn' 	=> 'required|alpha',
        'alder' 		=> 'nullable|numeric',
        'telefon' 		=> 'nullable|numeric',
        'mobil' 		=> 'required|numeric',
      ]);
    }
}
