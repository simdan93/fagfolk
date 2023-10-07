<?php

namespace Fagfolk\Http\Controllers;

use Illuminate\Http\Request;
use Fagfolk\Http\Controllers\Controller;

use Fagfolk\Company;
use Fagfolk\Notifications\No\CompanyUserAcceptedResponseNotification;

use Auth;
use DB;
use App;
use Log;

class UserResponseController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:privateUser');
    }

    public function acceptResponse($responseID, $needID)
    {
      //Update respons with accepted from false to true
      DB::update('UPDATE user_responses SET akseptert = true WHERE id = ?', [$responseID]);
      $userNeed = DB::select('SELECT * FROM user_needs WHERE id = ?', [$needID]);
      if ($userNeed[0]->befaring == 1)
      {
        if($userNeed[0]->antall_aksepterte_befaringer < 5)
        {
          DB::update('UPDATE user_needs SET antall_aksepterte_befaringer = antall_aksepterte_befaringer + 1 WHERE id = ?', [$needID]);
          if($userNeed[0]->antall_aksepterte_befaringer == 4)
            DB::update('UPDATE user_needs SET gyldig = false WHERE id = ?', [$needID]);
        }
        else {
          DB::update('UPDATE user_needs SET gyldig = false WHERE id = ?', [$needID]);
        }
      }
      else
        DB::update('UPDATE user_needs SET gyldig = false WHERE id = ?', [$needID]);
      //Send mail to company about the good news
      //$return = $this->sendMail($responseID);
      $return = true;
      if ($return == true)
        return redirect()->intended(route('user.usersResponses'))->with('mailSent', 'Epost sent!');
      else
        return redirect()->intended(route('user.usersResponses'))->with('mailNotSent', 'Epost ikke sendt.');
    }

    public function ignoreResponse($responseID, $needID)
    {
    	//Update respons with ignored from false to true
        DB::update('update user_responses set ignorert = true where id = ?', [$responseID]);
        DB::update('UPDATE user_needs SET gyldig = false WHERE id = ?', [$needID]);
        //$this->resetColoumn();
        return redirect()->intended(route('user.dashboard'));
    }

    protected function sendMail($responseID)
    {
    	//Send mail to company that their response has been accepted through mail
    	$sql = 'SELECT c.id
				FROM user_responses ur, companies c
				WHERE ur.id = ?
				AND ur.company_id = c.id';
    	$companyInfo = DB::select($sql, [$responseID]);
    	$company = Company::find($companyInfo[0]->id);
    	$company->notify(new CompanyUserAcceptedResponseNotification());
		return true;
    }
}
