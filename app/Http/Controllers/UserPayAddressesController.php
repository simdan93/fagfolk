<?php

namespace Fagfolk\Http\Controllers;

use Illuminate\Http\Request;
use Fagfolk\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

use Fagfolk\UserPayAddress;
use Auth;
use DB;
use App;

class UserPayAddressesController extends Controller
{    
    //Create a new controller instance.
    public function __construct()
    {
        $this->middleware('auth:privateUser');
    }
    
    public function showUpdateForm()
    {
    	$userID = Auth::user()->id;
    	$sql = "SELECT ppa.id, ppa.faktura_addresse, ppa.faktura_postnummer, ppa.faktura_by  
    			FROM user_pay_addresses ppa, users u 
    			WHERE u.id = ppa.user_id AND u.id = ?";
    	$payAddress = DB::select($sql,[$userID]);      
    	
    	if (App::getLocale() == 'en')
			return view( 'user.details.update-pay-address', ['payAddress' => $payAddress]  );
		else
			return view( 'no.user.details.update-pay-address', ['payAddress' => $payAddress]  );
    }
    
    public function updateDetails(Request $request, $u_pay_addr_id)
    {
    	$input = $request->all();
    	$this->validator($input)->validate();
    	//Validates data
		$payAddress = $request->input('faktura_addresse');
    	$payPostNr = $request->input('faktura_postnummer');
    	$payLocation = $request->input('faktura_by');
    	
		DB::update('UPDATE user_pay_addresses SET faktura_addresse = ? WHERE id = ?',[$payAddress, $u_pay_addr_id]);
		DB::update('UPDATE user_pay_addresses SET faktura_postnummer = ? WHERE id = ?',[$payPostNr, $u_pay_addr_id]);
		DB::update('UPDATE user_pay_addresses SET faktura_by = ? WHERE id = ?',[$payLocation, $u_pay_addr_id]);

		//Redirects to dashboard
		if (App::getLocale() == 'en')
			return redirect()->intended(route('user.details'))->with('detailsUpdated', 'Pay address updated!');
		else
        	return redirect()->intended(route('user.details'))->with('detailsUpdated', 'Fakturaaddresse oppdatert!');
    }
    
    protected function validator(array $data)
    {
         return Validator::make($data, [
        	'faktura_addresse' 		=> 'required|string',
			'faktura_postnummer' 	=> 'required|string',
			'faktura_by'			=> 'required|string',
        ]);
    }
}
