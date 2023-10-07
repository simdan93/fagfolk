<?php

namespace Fagfolk\Http\Controllers;

use Illuminate\Http\Request;

use Fagfolk\Http\Controllers\Controller;

use Fagfolk\UserResponse;
use Fagfolk\CompanyResponse;
use Fagfolk\User;
use Fagfolk\Company;

use Fagfolk\Notifications\No\UserResponseFromCompanyNotification;
use Fagfolk\Notifications\No\UserResponseFromAnotherCompanyNotification;

use Auth;
use DB;
use App;
use Response;
use Log;

class RequestUpdateController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:company');
    }

    public function getRequests()
    {
      require(app_path('functions/convertIDToName.php'));
      $myCompanyID = Auth::user()->id;
      $companyDetails = DB::select('SELECT * FROM company_details WHERE company_id = ?', [$myCompanyID]);

      $sql = "SELECT un.id, un.mainservice_id, un.secondaryservice_id, un.tilgjengelig, un.oppsummering, un.beskrivelse, un.gyldig, un.befaring, u.navn, u.etternavn, cw.postnummer
              FROM users u, user_needs un, company_services cs, company_details cd, company_work_areas cw
              WHERE cs.company_id = ?
              AND u.id = un.user_id
              AND cd.company_id = cs.company_id
              AND cw.company_id = cs.company_id
              AND un.mainservice_id =  cs.mainservice_id
              AND un.secondaryservice_id = cs.secondaryservice_id
              AND un.postnummer = cw.postnummer";
      $userNeeds = DB::select($sql, [$myCompanyID]);
      //Checking if any company need has already been responded by the company before. If so we do not include it in the list
      $validUserNeeds = $userNeeds;
      $userResponses = DB::select("SELECT * FROM user_responses");
      foreach($validUserNeeds as $key=>$userneed)
      {
        foreach($userResponses as $keyR=>$response)
        {
        	if ($userneed->id == $response->userneed_id)
        	{
        		if ($response->company_id == $myCompanyID)
        		{
        			unset($validUserNeeds[$key]);
        		}
        	}

        }
      }
      //$userNeeds = DB::select("SELECT * FROM user_needs WHERE company_id = ?", [$companyID]);
      $validUserNeeds = convertIDToName($validUserNeeds);

      $sql = "SELECT cn.id, cn.req_company_id, cn.mainservice_id, cn.secondaryservice_id, cn.tilgjengelig, cn.oppsummering, cn.beskrivelse, cn.gyldig, cn.befaring, cw.postnummer
              FROM company_needs cn, company_services cs, company_details cd, company_work_areas cw
              WHERE cs.company_id = ?
              AND cn.req_company_id NOT IN (?)
              AND cd.company_id = cs.company_id
              AND cw.company_id = cs.company_id
              AND cn.mainservice_id =  cs.mainservice_id
              AND cn.secondaryservice_id = cs.secondaryservice_id
              AND cn.postnummer = cw.postnummer";
      $companyNeeds = DB::select($sql, [$myCompanyID, $myCompanyID]);
      //Checking if any company need has already been responded by the company before. If so we do not include it in the list
      $validCompanyNeeds = $companyNeeds;
      $companyResponses = DB::select("SELECT * FROM company_responses");
      foreach($validCompanyNeeds as $key=>$companyneed)
      {
        foreach($companyResponses as $keyR=>$response)
        {
        	if ($companyneed->id == $response->companyneed_id)
        	{
        		if ($response->company_id == $myCompanyID)
        		{
        			unset($validCompanyNeeds[$key]);
        		}
        	}

        }
      }
      $validCompanyNeeds = convertIDToName($validCompanyNeeds);

      $reqCompanyName = array();
      //Get information about the requester
      foreach($validCompanyNeeds as $companyneed)
      {
        $sql = "SELECT *
                FROM companies c, company_details cd
                WHERE c.id = ?
                AND c.id = cd.company_id";
        $reqCompanyInfo = DB::select($sql, [$companyneed->req_company_id]);
        $reqCompanyName[] = $reqCompanyInfo[0]->selskap;
      }
      if (App::getLocale() == 'en')
        return view('company.requests', compact('validUserNeeds', 'validCompanyNeeds', 'reqCompanyName', 'companyDetails'));
      else
        return view('no.company.requests', compact('validUserNeeds', 'validCompanyNeeds', 'reqCompanyName', 'companyDetails'));
    }

    public function submitAcceptRequestUser(Request $request, $reqUserNeedID)
    {
      $input = $request->all();
      $this->createUserResponse($input, $reqUserNeedID);
      $return = $this->sendMailToUser($reqUserNeedID, 0);
      if($return == true)
        return redirect()->intended(route('company.requests'))->with('mailSent', 'Mail sent!');
      else
        return redirect()->intended(route('company.requests'))->with('mailNotSent', 'Mail ikke sent!');
    }

    public function submitAcceptRequestCompany(Request $request, $reqCompanyNeedID)
    {
      $input = $request->all();
      $this->createCompanyResponse($input,  $reqCompanyNeedID);
      $return = $this->sendMailToUser(0, $reqCompanyNeedID);
      if($return == true)
        return redirect()->intended(route('company.requests'))->with('mailSent', 'Mail sent!');
      else
        return redirect()->intended(route('company.requests'))->with('mailNotSent', 'Mail ikke sent!');
    }

    protected function createUserResponse(array $data, $needID)
    {
    	$msg = $data['response_message'];
    	$userID = DB::select('SELECT user_id FROM user_needs WHERE id = ?', [$needID]);
        return UserResponse::create([
            'user_id' => $userID[0]->user_id,
            'company_id' => Auth::user()->id,
            'userneed_id' =>  $needID,
            'response_message' => $msg,
        ]);
    }

    protected function createCompanyResponse(array $data, $needID)
    {
    	$msg = $data['response_message'];
    	$reqCompanyID = DB::select('SELECT req_company_id FROM company_needs WHERE id = ?', [$needID]);
        return CompanyResponse::create([
            'req_company_id' => $reqCompanyID[0]->req_company_id,
            'company_id' => Auth::user()->id,
            'companyneed_id' =>  $needID,
            'response_message' => $msg,
        ]);
    }

    public function showResponseConfirmation()
    {
    	if (App::getLocale() == 'en')
    		return view('company.response-submitted');
      else
      	return view('no.company.response-submitted');
    }

    public function moreInfoCustomerNeed($unID)
    {
  		//validate data
  		//$this->validateDescription($input)->validate();
  		$userNeed = DB::select('SELECT * FROM user_needs WHERE id = ?', [$unID]);
  		$response = json_encode ($userNeed);

  		return Response::json( $response );
    }

    public function moreInfoCompanyNeed($cnID)
    {
		//validate data
		//$this->validateDescription($input)->validate();
		$companyNeed = DB::select('SELECT * FROM company_needs WHERE id = ?', [$cnID]);
		$response = json_encode ($companyNeed);

		return Response::json( $response );
    }

	protected function sendMailToUser($userNeedID, $companyNeedID)
    {
		if($userNeedID != 0)
		{
			$sql = 'SELECT *
					FROM user_needs un, users u
					WHERE un.id = ?
					AND u.id = un.user_id';
			$reqUser = DB::select($sql, [$userNeedID]);
			$user = User::find($reqUser[0]->id);
			$user->notify(new UserResponseFromCompanyNotification());
		}
		else
		{
			$sql = 'SELECT c.id
					FROM company_needs cn, companies c
					WHERE cn.id = ?
					AND c.id = cn.req_company_id';
			$reqCompany = DB::select($sql, [$companyNeedID]);
			$company = Company::find($reqCompany[0]->id);
			$company->notify(new UserResponseFromAnotherCompanyNotification());
		}
		return true;
    }
}
