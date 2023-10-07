<?php

namespace Fagfolk\Http\Controllers;

use Illuminate\Http\Request;
use Fagfolk\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

use Fagfolk\Notifications\No\CompanyRequestMatchNotification;

use Fagfolk\CompanyNeed;
use Fagfolk\Company;

use Auth;
use DB;
use App;
use Response;
use Log;

class FindHelpCompanyController extends Controller
{
	public function __construct()
    {
        $this->middleware('auth:company');
    }

		public function moreInfoMyNeed($unID)
    {
			//validate data
			//$this->validateDescription($input)->validate();
			$userNeed = DB::select('SELECT * FROM company_needs WHERE id = ?', [$unID]);
			$response = json_encode ($userNeed);

			return Response::json( $response );
    }

    public function showRegisterForm()
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
			$mainServices = DB::select('SELECT * FROM main_services');
			if (App::getLocale() == 'en')
				return view('company.find-help', compact('officeAdress', 'payAdress', 'mainServices'));
			else
				return view('no.company.find-help', compact('officeAdress', 'payAdress', 'mainServices'));

    }

		public function showRegisterForm2($secService_id)
    {
			require(app_path('functions/convertIDToName.php'));
			$companyID = Auth::user()->id;
    	$sql = "SELECT cpa.id, cpa.faktura_addresse, cpa.faktura_postnummer, cpa.faktura_by
		    			FROM company_pay_adresses cpa, companies c
		    			WHERE c.id = cpa.company_id AND c.id = ?";
    	$payAdress = DB::select($sql,[$companyID]);

      $sql = "SELECT coa.id, coa.kontor_addresse, coa.kontor_postnummer, coa.kontor_by
		    			FROM company_office_adresses coa, companies c
		    			WHERE c.id = coa.company_id AND c.id = ?";
    	$officeAdress = DB::select($sql,[$companyID]);
			$mainServices = DB::select('SELECT * FROM main_services');
			$secServices_from_arg = DB::select('SELECT * FROM secondary_services WHERE id = ?', [$secService_id]);
			$secServices_pre_ajax = DB::select('SELECT * FROM secondary_services WHERE mainservice_id = ?', [$secServices_from_arg[0]->mainservice_id]);

			$secServices_from_arg_conv = DB::select('SELECT * FROM secondary_services WHERE id = ?', [$secService_id]);
			$secServices_from_arg_conv = convertIDToName($secServices_from_arg_conv);

			if (App::getLocale() == 'en')
				return view('company.find-help', compact('officeAdress', 'payAdress', 'mainServices', 'secServices_from_arg', 'secServices_from_arg_conv', 'secServices_pre_ajax'));
			else
				return view('no.company.find-help', compact('officeAdress', 'payAdress', 'mainServices', 'secServices_from_arg', 'secServices_from_arg_conv', 'secServices_pre_ajax'));

    }

		public function showRegisterForm3($mainService_id)
    {
			require(app_path('functions/convertIDToName.php'));
			$companyID = Auth::user()->id;
    	$sql = "SELECT cpa.id, cpa.faktura_addresse, cpa.faktura_postnummer, cpa.faktura_by
		    			FROM company_pay_adresses cpa, companies c
		    			WHERE c.id = cpa.company_id AND c.id = ?";
    	$payAdress = DB::select($sql,[$companyID]);

      $sql = "SELECT coa.id, coa.kontor_addresse, coa.kontor_postnummer, coa.kontor_by
		    			FROM company_office_adresses coa, companies c
		    			WHERE c.id = coa.company_id AND c.id = ?";
    	$officeAdress = DB::select($sql,[$companyID]);
			$mainServices = DB::select('SELECT * FROM main_services');
			$mainService = DB::select('SELECT * FROM main_services WHERE id = ?', [$mainService_id]);

			if (App::getLocale() == 'en')
				return view('company.find-help', compact('officeAdress', 'payAdress', 'mainServices', 'mainService'));
			else
				return view('no.company.find-help', compact('officeAdress', 'payAdress', 'mainServices', 'mainService'));

    }

    public function sjekk_servicer($mainservice_id)
    {
			$sql = 'SELECT * FROM secondary_services WHERE mainservice_id = ?';

			$servicer = DB::select($sql, [$mainservice_id]);
			$response = json_encode ($servicer);

			return response()->json( $response );
    }

    public function checkInfo($mainservice, $secondaryservice, $postnummer, $tilgjengelig)
    {
			require(app_path('functions/checkInfo.php'));
			$companies = checkInfo($mainservice, $secondaryservice, $postnummer, $tilgjengelig);
			Log::info($companies);
			$response = json_encode ($companies);
			return Response::json( $response );
    }

    public function registerNeed(Request $request)
    {
			$input = $request->all();
			//Validates data
			//$this->validator($input)->validate();
			//Create profession
			$this->create($input);
			//Send mail to companies that has criterias
			$return = $this->sendMail($input);
			if ($return == true)
				return redirect()->intended(route('company.dashboard'))->with('mailSent', 'Epost sent!');
			else
				return redirect()->intended(route('company.dashboard'))->with('mailNotSent', 'Epost ikke sendt. Fant ingen selskap med dine kriterier.');
    }

		protected function validateCheck(array $data)
    {
			return true;
			/*
        return Validator::make($data, [
					//'mainservice_id' 		=> 'required|numeric',
					//'secondaryservice_id' 	=> '',
					'postnummer' 			=> 'required|numeric',
					'oppsummering' 			=> 'required',
					//'tilgjengelig' 			=> 'required|',
        ]);
				*/
    }
    protected function validator(array $data)
    {
        return Validator::make($data, [
					//'mainservice_id' 		=> 'required|numeric',
					//'secondaryservice_id' 	=> '',
					'postnummer' 			=> 'required|numeric',
					'oppsummering' 			=> 'required',
					//'tilgjengelig' 			=> 'required|',
        ]);
    }

    protected function create(array $data)
    {
        return CompanyNeed::create([
        		'req_company_id' => Auth::user()->id,
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
					AND cw.company_id = cd.company_id
					AND cs.mainservice_id = ?
					AND cs.secondaryservice_id = ?
					AND cw.postnummer = ?';
			$companies = DB::select($sql, [$mainserviceID, $secondaryserviceID, $postnummer]);
			if(array_filter($companies) != false) //Check if its not empty
			{
				foreach($companies as $companyInfo)
				{
					//Check if the requesting company is in the list
					if($companyInfo->company_id != Auth::user()->id)
					{
						$company = Company::find($companyInfo->company_id);
						$company->notify(new CompanyRequestMatchNotification());
					}
				}
				return true;
			}
			return false;
		}
}
