<?php

namespace Fagfolk\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use DB;
use App;

class CompanyEditNeedController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:company');
    }

    public function deleteNeed($cnID)
    {
    	//Delete need for user
        DB::delete('DELETE FROM company_needs WHERE id = ?', [$cnID]);
        return redirect()->intended(route('company.usersNeeds'));
    }
    /*
    public function showUpdateForm($cnID)
    {
    	$cnInfo = DB::select('select * from company_needs where cnID = ?',[$cnID]);
    	if (App::getLocale() == 'en')
    		return view( 'company.update-company-need-details', ['cnInfo'=> $cnInfo] );
    	else
    		return view( 'no.company.update-company-need-details', ['cnInfo'=> $cnInfo] );
    }

    public function updateNeed(Request $request, $cnID)
    {
    	$professionMain = $request->input('hovedfag');
    	$professionSpec = $request->input('spesialisering');
    	$postNr = $request->input('postnummer');
    	$hourlyRate = $request->input('timepris');
    	$attendanceRate = $request->input('oppmøtepris');
    	$availableDate = $request->input('tilgjengelig');

		DB::update('UPDATE company_needs SET hovedfag = ? WHERE cnID = ?',[$professionMain, $cnID]);
		DB::update('UPDATE company_needs SET spesialisering = ? WHERE cnID = ?',[$professionSpec, $cnID]);
		DB::update('UPDATE company_needs SET postnummer = ? WHERE cnID = ?',[$postNr, $cnID]);
		DB::update('UPDATE company_needs SET timepris = ? WHERE cnID = ?',[$hourlyRate, $cnID]);
		DB::update('UPDATE company_needs SET oppmøtepris = ? WHERE cnID = ?',[$attendanceRate, $cnID]);
		DB::update('UPDATE company_needs SET tilgjengelig = ? WHERE cnID = ?',[$availableDate, $cnID]);
		//Redirects to dashboard
		if (App::getLocale() == 'en')
			return redirect()->intended(route('company.dashboard'))->with('cnUpdated','Forespørselen til selskapet er oppdatert.');
		else
			return redirect()->intended(route('company.dashboard'))->with('cnUpdated','Request has been updated.');

	}
	*/
}
