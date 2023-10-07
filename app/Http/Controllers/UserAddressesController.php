<?php

namespace Fagfolk\Http\Controllers;

use Illuminate\Http\Request;
use Fagfolk\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

use Fagfolk\UserHomeAddress;
use Fagfolk\UserPayAddress;
use Auth;
use DB;
use App;

class UserAddressesController extends Controller
{
    //Create a new controller instance.
    public function __construct()
    {
        $this->middleware('auth:privateUser');
    }
/*
    public function showRegistrationForm()
    {
    	if (App::getLocale() == 'en')
    		return view( 'user.details.register-addresses' );
    	else
    		return view( 'no.user.details.register-addresses' );
    }
    */
    public function showRegistrationForm()
    {
    	if (App::getLocale() == 'en')
    		return view( 'user.details.register_addresses' );
    	else
    		return view( 'no.user.details.register_addresses' );
    }
    public function showUpdateForm()
    {
      $userID = Auth::user()->id;
    	$sql = "SELECT ppa.id, ppa.faktura_addresse, ppa.faktura_postnummer, ppa.faktura_by
    			FROM user_pay_addresses ppa, users u
    			WHERE u.id = ppa.user_id AND u.id = ?";
    	$payAddress = DB::select($sql,[$userID]);

      $sql = "SELECT pha.id, pha.addresse, pha.postnummer, pha.sted
    			FROM user_home_addresses pha, users u
    			WHERE u.id = pha.user_id AND u.id = ?";
    	$homeAddress = DB::select($sql,[$userID]);

    	if (App::getLocale() == 'en')
    		return view( 'user.details.update_adresses', compact('homeAddress', 'payAddress') );
    	else
    		return view( 'no.user.details.update_adresses', compact('homeAddress', 'payAddress') );
    }
    /*
    //Handles registration request for company
    public function register(Request $request)
    {
    	$input = $request->all();
     //Validates data
      $this->validator($input)->validate();
     //Create Company
      $this->createHome($input);
      $this->createPay($input);
     //Redirects Company

     if (App::getLocale() == 'en')
     	   return redirect()->intended(route('user.details'))->with('detailsUpdated', 'Addresses succsessfully registered!');
     else
     	   return redirect()->intended(route('user.details'))->with('detailsUpdated', 'Addresser registrert!');
    }
*/
    public function register(Request $request)
    {
    	$input = $request->all();
     //Validates data
      $this->validator($input)->validate();
     //Create Company
      $this->createHome($input);
      $this->createPay($input);
     //Redirects Company
     $previous = str_replace(url('/'), '', url()->previous());
     if (App::getLocale() == 'en')
     	   return redirect()->intended(route('user.dashboard'))->with('registrationComplete', 'Your account is ready!');
     else
      if ($previous == '/'){
        return redirect()->intended(route('user.dashboard'))->with('registrationComplete', 'Brukerkontoen din er klar til bruk!');
      }
      else {
        return redirect()->intended($previous)->with('registrationComplete', 'Brukerkontoen din er klar til bruk!');
      }
    }

    //Create a new user instance after a valid registration.
    protected function createHome(array $data)
    {
    	$userID = Auth::user()->id;
        return UserHomeAddress::create([
        	'user_id' => $userID,
        	'addresse' => $data['addresse'],
            'postnummer' => $data['postnummer'],
            'sted' => $data['sted'],
        ]);
    }
    //Create a new user instance after a valid registration.
    protected function createPay(array $data)
    {
    	$userID = Auth::user()->id;
        return UserPayAddress::create([
        	'user_id' => $userID,
        	'faktura_addresse' => $data['faktura_addresse'],
            'faktura_postnummer' => $data['faktura_postnummer'],
            'faktura_by' => $data['faktura_by'],
        ]);
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

      $payAddress = $request->input('faktura_addresse');
      $payPostNr = $request->input('faktura_postnummer');
      $payLocation = $request->input('faktura_by');

      DB::update('UPDATE user_pay_addresses SET faktura_addresse = ? WHERE user_id = ?',[$payAddress, $userID]);
      DB::update('UPDATE user_pay_addresses SET faktura_postnummer = ? WHERE user_id = ?',[$payPostNr, $userID]);
      DB::update('UPDATE user_pay_addresses SET faktura_by = ? WHERE user_id = ?',[$payLocation, $userID]);

  		//Redirects to dashboard
  		if (App::getLocale() == 'en')
  			return redirect()->intended(route('user.details'))->with('detailsUpdated', 'Addresses updated!');
  		else
      	return redirect()->intended(route('user.details'))->with('detailsUpdated', 'Addresser oppdatert!');
    }

    protected function validator(array $data)
    {
         return Validator::make($data, [
        	'addresse' 		=> 'required|string',
    			'postnummer'	=> 'required|string',
    			'sted' 			=> 'required|string',
          'faktura_addresse' 		=> 'required|string',
          'faktura_postnummer' 	=> 'required|string',
          'faktura_by'			=> 'required|string',
        ]);
    }



}
