<?php

namespace Fagfolk\Http\Controllers;

use Illuminate\Http\Request;

use Auth;
use DB;
use App;

class CompanyProfileController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:company');
    }
    public function showProfile()
    {
      $myCompanyID = Auth::user()->id;
      $companyInfo = DB::select('SELECT * FROM companies WHERE id = ?', [$myCompanyID]);
      //Get company details
      $companyDetails = DB::select('SELECT * FROM company_details WHERE company_id = ?', [$myCompanyID]);
    	if (App::getLocale() == 'en')
    		return view( 'company.my_profile', compact('companyDetails', 'companyInfo'));
    	else
    		return view( 'no.company.my_profile', compact('companyDetails', 'companyInfo'));
    }
}
