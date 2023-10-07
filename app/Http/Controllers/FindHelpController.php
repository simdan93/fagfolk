<?php

namespace Fagfolk\Http\Controllers;

use Illuminate\Http\Request;
use Fagfolk\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

use Fagfolk\Notifications\No\CompanyRequestMatchNotification;

use Fagfolk\UserNeed;
use Fagfolk\Company;

use Auth;
use DB;
use App;
use Response;
use Log;

class FindHelpController extends Controller
{
	public function __construct()
	{
	    $this->middleware('auth:privateUser');
	}

	public function moreInfoMyNeed($unID)
	{
		//validate data
		//$this->validateDescription($input)->validate();
		$userNeed = DB::select('SELECT * FROM user_needs WHERE id = ?', [$unID]);
		$response = json_encode ($userNeed);

		return Response::json( $response );
	}

  public function showRegisterForm()
  {
		$userID = Auth::user()->id;
		$sql = "SELECT ppa.id, ppa.faktura_addresse, ppa.faktura_postnummer, ppa.faktura_by
				FROM user_pay_addresses ppa, users u
				WHERE u.id = ppa.user_id AND u.id = ?";
		$payAdress = DB::select($sql,[$userID]);

		$sql = "SELECT pha.id, pha.addresse, pha.postnummer, pha.sted
				FROM user_home_addresses pha, users u
				WHERE u.id = pha.user_id AND u.id = ?";
		$homeAdress = DB::select($sql,[$userID]);
			$mainServices = DB::select('SELECT * FROM main_services');
		if (App::getLocale() == 'en')
			return view( 'user.find-help', compact('homeAdress', 'payAdress', 'mainServices'));
		else
			return view( 'no.user.find-help', compact('homeAdress', 'payAdress', 'mainServices'));
  }

	public function showRegisterForm2($secService_id)
  {
		require(app_path('functions/convertIDToName.php'));
		$userID = Auth::user()->id;
		$sql = "SELECT ppa.id, ppa.faktura_addresse, ppa.faktura_postnummer, ppa.faktura_by
				FROM user_pay_addresses ppa, users u
				WHERE u.id = ppa.user_id AND u.id = ?";
		$payAdress = DB::select($sql,[$userID]);

		$sql = "SELECT pha.id, pha.addresse, pha.postnummer, pha.sted
				FROM user_home_addresses pha, users u
				WHERE u.id = pha.user_id AND u.id = ?";
		$homeAdress = DB::select($sql,[$userID]);
		$mainServices = DB::select('SELECT * FROM main_services');
		$secServices_from_arg = DB::select('SELECT * FROM secondary_services WHERE id = ?', [$secService_id]);
		$secServices_pre_ajax = DB::select('SELECT * FROM secondary_services WHERE mainservice_id = ?', [$secServices_from_arg[0]->mainservice_id]);

		$secServices_from_arg_conv = DB::select('SELECT * FROM secondary_services WHERE id = ?', [$secService_id]);
		$secServices_from_arg_conv = convertIDToName($secServices_from_arg_conv);
		if (App::getLocale() == 'en')
			return view('user.find-help', compact('homeAdress', 'payAdress', 'mainServices', 'secServices_from_arg', 'secServices_from_arg_conv', 'secServices_pre_ajax', 'mainService_name'));
		else
			return view('no.user.find-help', compact('homeAdress', 'payAdress', 'mainServices', 'secServices_from_arg', 'secServices_from_arg_conv', 'secServices_pre_ajax', 'mainService_name'));
  }

	public function showRegisterForm3($mainservice_id)
  {
		require(app_path('functions/convertIDToName.php'));
		$userID = Auth::user()->id;
		$sql = "SELECT ppa.id, ppa.faktura_addresse, ppa.faktura_postnummer, ppa.faktura_by
				FROM user_pay_addresses ppa, users u
				WHERE u.id = ppa.user_id AND u.id = ?";
		$payAdress = DB::select($sql,[$userID]);

		$sql = "SELECT pha.id, pha.addresse, pha.postnummer, pha.sted
				FROM user_home_addresses pha, users u
				WHERE u.id = pha.user_id AND u.id = ?";
		$homeAdress = DB::select($sql,[$userID]);
		$mainServices = DB::select('SELECT * FROM main_services');
		$mainService = DB::select('SELECT * FROM main_services WHERE id = ?', [$mainservice_id]);
		if (App::getLocale() == 'en')
			return view( 'user.find-help', compact('homeAdress', 'payAdress', 'mainServices', 'mainService'));
		else
			return view( 'no.user.find-help', compact('homeAdress', 'payAdress', 'mainServices', 'mainService'));
  }

  public function sjekk_servicer($mainservice_id)
  {
		Log::info($mainservice_id);
  	$sql = 'SELECT * FROM secondary_services WHERE mainservice_id = ?';

		$servicer = DB::select($sql, [$mainservice_id]);
		$response = json_encode ($servicer);

		return response()->json( $response );
  }

  public function checkInfo($mainservice, $secondaryservice, $postnummer, $tilgjengelig)
  {
		require(app_path('functions/checkInfo.php'));
		$companies = checkInfo($mainservice, $secondaryservice, $postnummer, $tilgjengelig);
		$response = json_encode ($companies);
		return response()->json( $response );
  }

  public function moreInfoNeed($unID)
  {
		//validate data
		//$this->validateDescription($input)->validate();
		$userNeed = DB::select('SELECT * FROM user_needs WHERE id = ?', [$unID]);
		$response = json_encode ($userNeed);

		return Response::json( $response );
  }

  public function registerNeed(Request $request)
  {
  	$input = $request->all();
    //Validates data
		//Log:info('Requestinfo:');
		Log:info($request);

	  $this->validator($input)->validate();
		$this->createNeed($input);
		//Send mail to companies that has criterias
		$return = $this->sendMail($input);
		if ($return == true)
			return redirect()->intended(route('user.usersNeeds'))->with('mailSent', 'Epost sent!');
		else
			return redirect()->intended(route('user.usersNeeds'))->with('mailNotSent', 'Epost ikke sendt. Fant ingen selskap med dine kriterier.');
  }

  protected function validator(array $data)
  {
		return Validator::make($data, [
			//'mainservice_id' 		=> 'required|numeric',
			//'secondaryservice_id' 	=> 'required|numeric',
			'postnummer' 			=> 'required|numeric',
			'oppsummering' 			=> 'required|string',
			//'beskrivelse' 			=> 'string',
			//'tilgjengelig' 			=> 'required',
			//'befaring' 			=> 'required',
		]);
  }

  protected function createNeed(array $data)
  {
    return UserNeed::create([
    	'user_id' => Auth::user()->id,
      'mainservice_id' => $data['mainservice'],
      'secondaryservice_id' => $data['secondaryservice'],
      'postnummer' => $data['postnummer'],
      'tilgjengelig' => $data['tilgjengelig'],
      'oppsummering' => $data['oppsummering'],
      'beskrivelse' => $data['beskrivelse'],
			'befaring' => $data['befaring'],
    ]);
  }

  protected function sendMail(array $criterias)
  {
		$mainserviceID = $criterias['mainservice'];
		$secondaryserviceID = $criterias['secondaryservice'];
		$postnummer = $criterias['postnummer'];
		//Send mail to companies that has the criterias
		$sql = 'SELECT cd.company_id, cs.mainservice_id, cs.secondaryservice_id, cw.postnummer
						FROM company_details cd, company_services cs, company_work_areas cw
						WHERE cs.company_id = cd.company_id
						AND cw.company_id = cs.company_id
						AND cs.mainservice_id = ?
						AND cs.secondaryservice_id = ?
						AND cw.postnummer = ?';
		$companies = DB::select($sql, [$mainserviceID, $secondaryserviceID, $postnummer]);
		if(array_filter($companies) != false) //Check if its not empty
		{
			foreach($companies as $company)
			{
				$company = Company::find($company->company_id);
				if (App::getLocale() == 'no')
					$company->notify(new CompanyRequestMatchNotification());
			}
			return true;
		}
		return false;
  }
}
