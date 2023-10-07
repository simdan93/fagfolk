<?php

namespace Fagfolk\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use DB;
use App;
use Log;

class CompanyController extends Controller
{
  public function __construct()
  {
    $this->middleware('auth:company');
  }

  public function getDBInfo()
  {
    require(app_path('functions/convertIDToName.php'));
    $myCompanyID = Auth::user()->id;

    //Get company details
    $companyDetails = DB::select('SELECT * FROM company_details WHERE company_id = ?', [$myCompanyID]);
    $sql = "SELECT cpa.id, cpa.faktura_addresse, cpa.faktura_postnummer, cpa.faktura_by
        FROM company_pay_adresses cpa, companies c
        WHERE c.id = cpa.company_id AND c.id = ?";
    $payAdress = DB::select($sql,[$myCompanyID]);

    $sql = "SELECT coa.id, coa.kontor_addresse, coa.kontor_postnummer, coa.kontor_by
        FROM company_office_adresses coa, companies c
        WHERE c.id = coa.company_id AND c.id = ?";
    $officeAdress = DB::select($sql,[$myCompanyID]);
    //$companyDetails = $this->convertIDToName($companyDetails);
    $companyServices = DB::select('SELECT * FROM company_services WHERE company_id = ?', [$myCompanyID]);
    $companyServices = convertIDToName($companyServices);
    //Check if any companyDetails exists
    $companyDetailsExists = DB::select('SELECT * FROM company_details');
    $companyInfo = DB::select('SELECT * FROM companies WHERE id = ?', [$myCompanyID]);
    $companyWorkAreas = DB::select('SELECT * FROM company_work_areas WHERE company_id = ?', [$myCompanyID]);

    if($companyDetails != null && $companyDetails != null) {
      session(['selskap' => $companyDetails[0]->selskap]);
      session(['org_nummer' => $companyDetails[0]->org_nummer]);
    }

    if (App::getLocale() == 'en')
      return view('company.my-dashboard', compact('companyDetails', 'companyDetailsExists', 'companyServices', 'companyInfo', 'payAdress', 'officeAdress', 'companyWorkAreas'));
    else
      return view('no.company.my-dashboard', compact('companyDetails', 'companyDetailsExists', 'companyServices', 'companyInfo', 'payAdress', 'officeAdress', 'companyWorkAreas'));
  }

  public function getDBInfoNeeds()
  {
    require(app_path('functions/convertIDToName.php'));
    $myCompanyID = Auth::user()->id;
    $companyNeeds = DB::select('SELECT * FROM company_needs WHERE req_company_id = ? ORDER BY created_at desc', [$myCompanyID]);
    $companyNeeds = convertIDToName($companyNeeds);
    if (App::getLocale() == 'en')
      return view('company.my-needs', compact('companyNeeds'));
    else
      return view('no.company.my-needs', compact('companyNeeds'));
  }

  public function getDBInfoResponsesToUsers()
  {
    require(app_path('functions/convertIDToName.php'));
    $myCompanyID = Auth::user()->id;
    //Get information about responses and the company info
    $sql = 'SELECT * FROM company_responses cr, company_needs cn, companies c
            WHERE cr.company_id = ?
            AND cr.companyneed_id = cn.id
            AND c.id = cn.req_company_id
            ORDER BY cn.id desc';
    $responseInfoToCompanies = DB::select($sql, [$myCompanyID]);
    $responseInfoToCompanies = convertIDToName($responseInfoToCompanies);
    //Go through list, if a row has akseptert = false, then we delete the email.
    foreach($responseInfoToCompanies as $RITCompany)
    {
      if($RITCompany->akseptert != true)
      {
        unset($RITCompany->email);
        unset($RITCompany->mobil);
      }
    }

    $sql = 'SELECT * FROM user_responses ur, user_needs un, users u
            WHERE ur.company_id = ?
            AND ur.userneed_id = un.id
            AND u.id = un.user_id
            ORDER BY un.id desc';
    $responseInfoToUsers = DB::select($sql, [$myCompanyID]);
    $responseInfoToUsers = convertIDToName($responseInfoToUsers);
    //Go through list, if a row has akseptert = false, then we delete the email.
    foreach($responseInfoToUsers as $RITuser)
    {
      if($RITuser->akseptert != true)
      {
        unset($RITuser->email);
        unset($RITuser->mobil);
      }
    }
    if (App::getLocale() == 'en')
      return view('company.my_responses_to_needs', compact('responseInfoToUsers', 'responseInfoToCompanies'));
    else
      return view('no.company.my_responses_to_needs', compact('responseInfoToUsers', 'responseInfoToCompanies'));

  }

  public function getDBInfoResponsesMyNeeds()
  {
    require(app_path('functions/convertIDToName.php'));
    $myCompanyID = Auth::user()->id;

    $sql = 'SELECT cr.id, cr.req_company_id, cr.akseptert, cr.ignorert, cr.response_message, cr.companyneed_id,
                    cd.selskap, cd.org_nummer,
                    cs.mainservice_id, cs.secondaryservice_id, cs.timepris, cs.oppmøtepris, cs.tilgjengelig,
                    cn.gyldig, cn.befaring, cn.oppsummering, cn.antall_aksepterte_befaringer
            FROM company_responses cr, company_details cd, company_services cs, company_needs cn
            WHERE cr.req_company_id = ?
            AND cd.company_id = cr.company_id
            AND cs.company_id = cr.company_id
            AND cn.id = cr.companyneed_id
            AND cs.mainservice_id = cn.mainservice_id
            AND cs.secondaryservice_id = cn.secondaryservice_id
            AND cr.ignorert NOT IN (1)
            ORDER BY cr.companyneed_id desc';
    $responseInfoFromCompanies = DB::select($sql, [$myCompanyID]);
    $responseInfoFromCompanies = convertIDToName($responseInfoFromCompanies);
    if (App::getLocale() == 'en')
      return view('company.responses_to_my_needs', compact('responseInfoFromCompanies'));
    else
      return view('no.company.responses_to_my_needs', compact('responseInfoFromCompanies'));
  }

  public function getDBInfoServices()
  {
    require(app_path('functions/convertIDToName.php'));
    $myCompanyID = Auth::user()->id;
    $oldCompanyService = DB::select('SELECT * FROM company_services WHERE company_id = ?', [$myCompanyID]);
    $mainServices = DB::select('SELECT * FROM main_services');
    //Check if user has any services
    if($oldCompanyService != null)
    {
      $oldmainservice_id = $oldCompanyService[0]->mainservice_id;
      $oldsecondaryservice_id = $oldCompanyService[0]->secondaryservice_id;

      $oldCompanyService = convertIDToName($oldCompanyService);

      $restOfServices = DB::select('SELECT *
                                    FROM secondary_services
                                    WHERE mainservice_id = ?
                                    AND id NOT IN (?)', [$oldmainservice_id, $oldsecondaryservice_id]
                                  );
      $restOfServicesIDs = array();
      foreach($restOfServices as $restOfService)
      {
        $restOfServicesIDs[] = $restOfService->id;
      }
      $restOfServices = convertIDToName($restOfServices);
    }
    if (App::getLocale() == 'en')
      return view('company.my-services', compact( 'oldsecondaryservice_id', 'oldmainservice_id', 'restOfServicesIDs', 'oldCompanyService', 'restOfServices', 'mainServices'));
    else
      return view('no.company.my-services', compact('oldsecondaryservice_id', 'oldmainservice_id', 'restOfServicesIDs', 'oldCompanyService', 'restOfServices', 'mainServices'));
  }
} //class
