<?php

namespace Fagfolk\Http\Controllers;

use Illuminate\Http\Request;
use Fagfolk\Http\Controllers\Controller;

use Fagfolk\Notifications\No\CompanyAcceptResponseNotification;
use Fagfolk\Company;

use Auth;
use DB;
use App;

class CompanyResponseController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:company');
    }

    public function acceptResponse($responseID, $needID)
    {
    	//Update respons with accepted from false to true
    	DB::update('UPDATE company_responses SET akseptert = true WHERE id = ?', [$responseID]);
      $companyNeed = DB::select('SELECT * FROM company_needs WHERE id = ?', [$needID]);
      if ($companyNeed[0]->befaring == 1)
      {
        if($companyNeed[0]->antall_aksepterte_befaringer < 5)
        {
          DB::update('UPDATE company_needs SET antall_aksepterte_befaringer = antall_aksepterte_befaringer + 1 WHERE id = ?', [$needID]);
          if($companyNeed[0]->antall_aksepterte_befaringer == 4)
            DB::update('UPDATE company_needs SET gyldig = false WHERE id = ?', [$needID]);
        }
        else {
          DB::update('UPDATE company_needs SET gyldig = false WHERE id = ?', [$needID]);
        }
      }
      else
        DB::update('UPDATE company_needs SET gyldig = false WHERE id = ?', [$needID]);

    	//Send mail to companies that has criterias
		//$return = $this->sendMail($responseID);
    $return = true;
		if($return == true)
			return redirect()->intended(route('company.dashboard'))->with('mailSent', 'Mail sent!');
		else
			return redirect()->intended(route('company.dashboard'))->with('mailNotSent', 'Mail ikke sent!');
    }

    public function ignoreResponse($responseID, $needID)
    {
    	//Update respons with ignored from false to true
        DB::update('update company_responses set ignorert = true where id = ?', [$responseID]);
        DB::update('UPDATE company_needs SET gyldig = false WHERE id = ?', [$needID]);
        //$this->resetColoumn();
        return redirect()->intended(route('company.dashboard'));
    }

    protected function sendMail($responseID)
    {
    	//Send mail to company that their response has been accepted through mail
    	$sql = 'SELECT c.id
				FROM company_responses cr, companies c
				WHERE cr.id = ?
				AND  cr.company_id = c.id';
    	$companyInfo = DB::select($sql, [$responseID]);
    	$company = Company::find($companyInfo[0]->id);
		$company->notify(new CompanyAcceptResponseNotification());

		return true;
    }
}
