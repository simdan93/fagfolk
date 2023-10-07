<?php

namespace Fagfolk\Http\Controllers;

use Illuminate\Http\Request;
use Fagfolk\UserNeed;
use Auth;
use DB;
use App;

class EditNeedController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:privateUser');
    }

    public function deleteNeed($unID)
    {
    	//Delete need for user
        DB::delete('DELETE FROM user_needs WHERE id = ?', [$unID]);
        return redirect()->intended(route('user.usersNeeds'));
		//return redirect(url()->previous().'#myRequest');
    }
    /*
    public function showUpdateForm($id)
    {
    	$needsInfo = DB::select('select * from needs where nID = ?',[$id]);
    	if (App::getLocale() == 'en')
    		return view( 'user.update-user-need-details', ['needsInfo'=> $needsInfo] );
    	else
    		return view( 'no.user.update-user-need-details', ['needsInfo'=> $needsInfo] );
    }

    public function updateNeed(Request $request, $id)
    {
    	$professionMain = $request->input('hovedfag');
    	$professionSpec = $request->input('spesialisering');
    	$postNr = $request->input('postnummer');
    	$availableDate = $request->input('tilgjengelig');

		DB::update('UPDATE needs SET hovedfag = ? WHERE nID = ?',[$professionMain, $id]);
		DB::update('UPDATE needs SET spesialisering = ? WHERE nID = ?',[$professionSpec, $id]);
		DB::update('UPDATE needs SET postnummer = ? WHERE nID = ?',[$postNr, $id]);
		DB::update('UPDATE needs SET tilgjengelig = ? WHERE nID = ?',[$availableDate, $id]);
		//Redirects to dashboard
		return redirect()->intended(route('user.dashboard'));
    }
    */
}
