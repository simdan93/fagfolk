<?php

namespace Fagfolk\Http\Controllers;

use Illuminate\Http\Request;
use Fagfolk\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

use Fagfolk\CompanyDetail;
use Fagfolk\CompanyWorkArea;
use Fagfolk\CompanyService;
use Auth;
use DB;
use App;
use Log;
use Response;

class CompanyDetailsController extends Controller
{
  //Create a new controller instance.
  public function __construct()
  {
      $this->middleware('auth:company');
  }

  public function showDBInfoDetails()
  {
    $myCompanyID = Auth::user()->id;
    $companyDetailsExists = DB::select('SELECT * FROM company_details');
    $companyDetails = DB::select('SELECT * FROM company_details WHERE company_id = ?', [$myCompanyID]);
    $companyInfo = DB::select('SELECT * FROM companies WHERE id = ?', [$myCompanyID]);
    $companyWorkAreas = DB::select('SELECT * FROM company_work_areas WHERE company_id = ?', [$myCompanyID]);

    $sqlOA = "SELECT coa.kontor_addresse, coa.kontor_postnummer, coa.kontor_by
        FROM company_office_adresses coa, companies c
        WHERE c.id = coa.company_id AND c.id = ?";
    $officeAdress = DB::select($sqlOA,[$myCompanyID]);

    $sqlPA = "SELECT cpa.faktura_addresse, cpa.faktura_postnummer, cpa.faktura_by
        FROM company_pay_adresses cpa, companies c
        WHERE c.id = cpa.company_id AND c.id = ?";
    $payAdress = DB::select($sqlPA,[$myCompanyID]);
    if (App::getLocale() == 'en')
      return view('company.configurations.my-details', compact( 'companyDetailsExists', 'companyDetails', 'companyInfo', 'officeAdress', 'payAdress', 'companyWorkAreas'));
    else
    if($companyDetails == null)
      return view('no.company.configurations.my-details_no_details', compact('companyInfo'));
    elseif ($officeAdress == null or $payAddress == null)
      return view('no.company.configurations.my-details_no_adresses', compact('companyDetailsExists', 'companyDetails', 'companyInfo', 'companyWorkAreas'));
    else
      return view('no.company.configurations.my-details', compact('companyDetailsExists', 'companyDetails', 'companyInfo', 'officeAdress', 'payAdress', 'companyWorkAreas'));
  }

  public function showRegistrationForm()
  {
  	if (App::getLocale() == 'en')
  	  return view( 'company.configurations.register-company-details' );
   	else
   	 	return view( 'no.company.configurations.register-company-details' );
  }

  public function showRegistrationFormWorkAreas()
  {
  	if (App::getLocale() == 'en')
  	  return view( 'company.configurations.register-company-work-area' );
   	else
   	 	return view( 'no.company.configurations.register-company-work-area' );
  }
  public function showRegistrationFormAddService()
  {
    $mainServices = DB::select('SELECT * FROM main_services');
  	if (App::getLocale() == 'en')
  	  return view( 'company.add-first-service', compact('mainServices'));
   	else
    	return view( 'no.company.add-first-service', compact('mainServices'));
  }
  public function showUpdateForm()
  {
  	$companyID = Auth::user()->id;
  	$companyDetails = DB::select('select * from company_details where company_id = ?',[$companyID]);
  	if (App::getLocale() == 'en')
  	  return view( 'company.configurations.update-company-details', compact( 'companyDetails'));
   	else
    	return view( 'no.company.configurations.update-company-details', compact( 'companyDetails'));
  }
  public function showUpdateFormServices($csID)
  {
    require(app_path('functions/convertIDToName.php'));
  	$companyID = Auth::user()->id;
  	$companyServices = DB::select('SELECT * FROM company_services WHERE id = ?',[$csID]);
    $relSecondaryServices = DB::select('SELECT * FROM secondary_services WHERE mainservice_id = ?',[$companyServices[0]->mainservice_id]);

  	$companyServices = convertIDToName($companyServices);
  	$relSecondaryServices = convertIDToName($relSecondaryServices);

  	if (App::getLocale() == 'en')
  	  return view( 'company.update-company-services', compact( 'companyServices', 'relSecondaryServices'));
   	else
    	return view( 'no.company.update-company-services', compact( 'companyServices', 'relSecondaryServices') );
  }

  //Handles registration request for company
  public function register(Request $request)
  {
     $input = $request->all();
     //Validates data
     $this->validateDetails($input)->validate();
     //Create Company
     $this->createCompanyDetails($input);
     //Redirects Company
  	  return redirect()->intended(route('company.register-addresses'));
  }

  public function registerWorkAreas(Request $request)
  {
    $companyID = Auth::user()->id;
    $workAreas = $request->all();

    for($i = 1; $i < count($request->postnummer); $i++){
        /*$validatedData = $request->postnummer[$i]->validate([
            'postnummer' => 'required|digits:4',
        ]);*/
        if($request->postnummer[$i] != null)
        {
          $workArea = new CompanyWorkArea();
          $workArea->company_id = $companyID;
          $workArea->postnummer = $request->postnummer[$i];
          $workArea->save();
        }
    }
    //Redirects Company
    return redirect()->intended(route('company.details'))->with('workAreaAdded', 'Nye arbeidsområder lagt til!');
  }

  public function registerService(Request $request)
  {
     $input = $request->all();
     //Validates data
     $this->validateServices($input)->validate();
     //Create Company
     $this->createServices($input);
     //Redirects Company
     return redirect()->intended(route('company.dashboard'))->with('registrationComplete', 'Your account is ready!');
  }

  public function registerNewService(Request $request)
  {
     $input = $request->all();
     //Validates data
     $this->validateServices($input)->validate();
     //Create Company
     $this->createServices($input);
     //Redirects Company
   	 return redirect()->intended(route('company.services'))->with('serviceAdded', 'Ny service lagt til!');
  }

  protected function validateDetails(array $data)
  {
      return Validator::make($data, [
      	'selskap' 		=> 'required|string',
    		'org_nummer' 	=> 'required|digits:9',
    		//'postnummer' 	=> 'required|digits:4',
      ]);
  }

  protected function validateworkAreas(array $data)
  {
      return Validator::make($data, [
    		'postnummer' 	=> 'required|digits:4',
      ]);
  }

  protected function validateServices(array $data)
  {
      return Validator::make($data, [
  			//'mainservice' 		=> 'required',
  			//'secondaryservice' 	=> 'nullable',
  			'timepris' 				=> 'required|numeric',
  			'oppmøtepris' 			=> 'required|numeric',
  			//'tilgjengelig' 			=> 'required|string',
      ]);
  }

  //Create a new user instance after a valid registration.
  protected function createCompanyDetails(array $data)
  {
     $companyID = Auth::user()->id;
     return CompanyDetail::create([
      	'company_id' 	=> $companyID,
      	'selskap' 		=> $data['selskap'],
        'org_nummer' 	=> $data['org_nummer'],
        //'postnummer' 	=> $data['postnummer'],
      ]);
  }

  protected function createServices(array $data)
  {
  	$companyID = Auth::user()->id;
  	return CompanyService::create([
      	'company_id' 			=> $companyID,
        'mainservice_id' 		=> $data['mainservice2'],
        'secondaryservice_id' 	=> $data['secondaryservice2'],
        'timepris' 				=> $data['timepris'],
        'oppmøtepris' 			=> $data['oppmøtepris'],
        //'tilgjengelig' 			=> $data['tilgjengelig'],
      ]);
  }

  public function updateDetails(Request $request)
  {
  	$companyID = Auth::user()->id;
  	$input = $request->all();
  	$this->validateDetails($input)->validate();
  	//Validates data

  	DB::update('UPDATE company_details SET selskap = ? WHERE company_id = ?',[$request->input('selskap'), $companyID]);
  	DB::update('UPDATE company_details SET org_nummer = ? WHERE company_id = ?',[$request->input('org_nummer'), $companyID]);

    session(['selskap' => $request->input('selskap')]);
    session(['org_nummer' => $request->input('org_nummer')]);
  	//Redirects to dashboard
  	return redirect()->intended(route('company.details'))->with('detailsUpdated', 'Detaljer oppdatert!');
  }

  public function updateWorkAreas(Request $request)
  {
    $companyID = Auth::user()->id;
    $input = $request->all();
    //$this->validateworkAreas($input['work_areas'])->validate();
    DB::table('company_work_areas')->where('company_id', $companyID)->delete();
    foreach ( $input['work_areas'] as $key => $work_area )
    {
      /*$resultID = DB::table('company_work_areas')
                    ->select('id')
                    ->where([
                      ['company_id', $companyID],
                      ['postnummer', $work_area],
                    ])->get();
      if($resultID != null)
        DB::table('company_work_areas')
          ->where('id', 1)
          ->update(array('postnummer' => $work_area));
      elseif($work_area != null)*/
      if ($work_area != "") {
        DB::table('company_work_areas')
          ->insert(['company_id' => $companyID, 'postnummer' => $work_area]);
        }

    }

    //Redirects to dashboard
    return redirect()->intended(route('company.details'))->with('detailsUpdated', 'Detaljer oppdatert!');
  }

  public function updateServices(Request $request, $csID)
  {
  	$input = $request->all();
  	$this->validateServices($input)->validate();

  	//Validates data
  	$professionMain = $request->input('mainservice');
  	$professionSpec = $request->input('secondaryservice');
  	$hourlyRate 	= $request->input('timepris');
  	$attendanceRate = $request->input('oppmøtepris');
  	//$available 		= $request->input('tilgjengelig');

  	DB::update('UPDATE company_services SET mainservice_id = ? WHERE id = ?',[$professionMain, $csID]);
  	DB::update('UPDATE company_services SET secondaryservice_id = ? WHERE id = ?',[$professionSpec, $csID]);
  	DB::update('UPDATE company_services SET timepris = ? WHERE id = ?',[$hourlyRate, $csID]);
  	DB::update('UPDATE company_services SET oppmøtepris = ? WHERE id = ?',[$attendanceRate, $csID]);
  	//DB::update('UPDATE company_services SET tilgjengelig = ? WHERE id = ?',[$available, $csID]);

  	//Redirects to dashboard
  	return redirect()->intended(route('company.services'))->with('serviceUpdated', 'Service oppdatert');
  }

  protected function deleteService ($csID)
  {
  	DB::delete('DELETE FROM company_services WHERE id = ?',[$csID]);
  	return redirect()->intended(route('company.services'))->with('serviceDeleted', 'Service slettet!');
  }

  public function getWorkAreas(Request $request)
  {
    $companyID = Auth::user()->id;
    $workAreas = DB::select('SELECT * FROM company_work_areas WHERE company_id = ?', [$companyID]);
    $response = json_encode ($workAreas);

    return Response::json( $response );
  }
}
