<?php

namespace Fagfolk\Http\Controllers;

use Illuminate\Http\Request;
use Fagfolk\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

use Fagfolk\CompanyOfficeAdress;
use Fagfolk\CompanyPayAdress;
use Auth;
use DB;
use App;

class CompanyAddressesController extends Controller
{
    //Create a new controller instance.
    public function __construct()
    {
        $this->middleware('auth:company');
    }
/*
    public function showRegistrationForm()
    {
    	if (App::getLocale() == 'en')
    		return view( 'company.configurations.register-addresses' );
    	else
    		return view( 'no.company.configurations.register-addresses' );
    }*/
    public function showRegistrationForm()
    {
    	if (App::getLocale() == 'en')
    		return view( 'company.configurations.register_addresses' );
    	else
    		return view( 'no.company.configurations.register_addresses' );
    }
    public function showUpdateForm()
    {
      $companyID = Auth::user()->id;
    	$sql = "SELECT cpa.id, cpa.faktura_addresse, cpa.faktura_postnummer, cpa.faktura_by
    			FROM company_pay_adresses cpa, companies c
    			WHERE c.id = cpa.company_id AND c.id = ?";
    	$payAdress = DB::select($sql,[$companyID]);

      $sql = "SELECT coa.id, coa.kontor_addresse, coa.kontor_postnummer, coa.kontor_by
    			FROM company_office_adresses coa, companies c
    			WHERE c.id = coa.company_id AND c.id = ?";
    	$officeAdress = DB::select($sql,[$companyID]);

    	if (App::getLocale() == 'en')
    		return view( 'company.configurations.update_adresses', compact('officeAdress', 'payAdress') );
    	else
    		return view( 'no.company.configurations.update_adresses', compact('officeAdress', 'payAdress') );
    }
    //Handles registration request for company
    /*public function register(Request $request)
    {
    	$input = $request->all();
     //Validates data
      $this->validator($input)->validate();
     //Create Company
      $this->createOffice($input);
      $this->createPay($input);
     //Redirects Company

     if (App::getLocale() == 'en')
     	   return redirect()->intended(route('company.details'))->with('detailsUpdated', 'Addresses succsessfully registered!');
     else
     	   return redirect()->intended(route('company.details'))->with('detailsUpdated', 'Addresser registrert!');
    }*/
    public function register(Request $request)
    {
      $input = $request->all();
      //Validates data
      $this->validator($input)->validate();
      //Create Company
      $this->createOffice($input);
      $this->createPay($input);
      //Redirects Company
      //$previous = str_replace(url('/'), '', url()->previous());
      if (App::getLocale() == 'en')
         return redirect()->intended(route('company.dashboard'));
      else
         return redirect()->intended(route('company.dashboard'))->with('registrationComplete', 'Brukerkontoen din er klar til bruk!');
    }
    //Create a new user instance after a valid registration.
    protected function createOffice(array $data)
    {
    	$companyID = Auth::user()->id;
        return CompanyOfficeAdress::create([
          'company_id' => $companyID,
          'kontor_addresse' => $data['kontor_addresse'],
          'kontor_postnummer' => $data['kontor_postnummer'],
          'kontor_by' => $data['kontor_by'],
        ]);
    }
    //Create a new user instance after a valid registration.
    protected function createPay(array $data)
    {
    	$companyID = Auth::user()->id;
        return CompanyPayAdress::create([
        	'company_id' => $companyID,
        	'faktura_addresse' => $data['faktura_addresse'],
            'faktura_postnummer' => $data['faktura_postnummer'],
            'faktura_by' => $data['faktura_by'],
        ]);
    }

    public function updateDetails(Request $request)
    {
      $companyID = Auth::user()->id;
    	$input = $request->all();
    	$this->validator($input)->validate();
    	//Validates data
    	$officeAddress = $request->input('kontor_addresse');
    	$officePostNr = $request->input('kontor_postnummer');
    	$officeLocation = $request->input('kontor_by');

  		DB::update('UPDATE company_office_adresses SET kontor_addresse = ? WHERE company_id = ?',[$officeAddress, $companyID]);
  		DB::update('UPDATE company_office_adresses SET kontor_postnummer = ? WHERE company_id = ?',[$officePostNr, $companyID]);
  		DB::update('UPDATE company_office_adresses SET kontor_by = ? WHERE company_id = ?',[$officeLocation, $companyID]);

      $payAddress = $request->input('faktura_addresse');
      $payPostNr = $request->input('faktura_postnummer');
      $payLocation = $request->input('faktura_by');

      DB::update('UPDATE company_pay_adresses SET faktura_addresse = ? WHERE company_id = ?',[$payAddress, $companyID]);
      DB::update('UPDATE company_pay_adresses SET faktura_postnummer = ? WHERE company_id = ?',[$payPostNr, $companyID]);
      DB::update('UPDATE company_pay_adresses SET faktura_by = ? WHERE company_id = ?',[$payLocation, $companyID]);

  		//Redirects to dashboard
  		if (App::getLocale() == 'en')
  			return redirect()->intended(route('company.details'))->with('detailsUpdated', 'Addresses updated!');
  		else
      	return redirect()->intended(route('company.details'))->with('detailsUpdated', 'Addresser oppdatert!');
    }

    protected function validator(array $data)
    {
         return Validator::make($data, [
          'kontor_addresse' 		=> 'required|string',
          'kontor_postnummer'	  => 'required|string',
          'kontor_by' 		     	=> 'required|string',
          'faktura_addresse' 		=> 'required|string',
          'faktura_postnummer' 	=> 'required|string',
          'faktura_by'		  	  => 'required|string',
        ]);
    }
}
