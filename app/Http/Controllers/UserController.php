<?php

namespace Fagfolk\Http\Controllers;

use Illuminate\Http\Request;
use App\Classes\HelpfullFunctions;

use Auth;
use DB;
use App;
use Log;


class UserController extends Controller
{
  public function __construct()
  {
    $this->middleware('auth:privateUser');
  }

  public function getDBInfo()
  {
    //Get id of user
    $userID = Auth::user()->id;
    /*
    //Get information about request sent from this user
    $userNeeds = DB::select('SELECT * from user_needs where user_id = ? ORDER BY created_at desc', [$userID]);
    //Get name from ID and replace array before sending back to user-view
    $userNeeds = $this->convertIDToName($userNeeds);
    //Get information about responses and the company info
    $sql = 'SELECT ur.id, ur.akseptert, ur.ignorert, ur.userneed_id, ur.response_message, ur.created_at, cd.selskap, cd.org_nummer, cd.postnummer, cs.mainservice_id, cs.secondaryservice_id, cs.timepris, cs.oppmøtepris, cs.tilgjengelig, un.gyldig, un.befaring
          FROM user_responses ur, companies c, company_details cd, company_services cs, user_needs un
          WHERE ur.user_id = ?
          AND c.id = ur.company_id
          AND cd.company_id = c.id
          AND cs.company_id = c.id
          AND un.id = ur.userneed_id
          AND ur.ignorert NOT IN (1)
          ORDER BY ur.created_at desc';
    $responseInfo = DB::select($sql, [$userID]);
    $responseInfo = $this->convertIDToName($responseInfo);
    */
    //$userInfo = DB::select('SELECT * FROM users WHERE id = ?', [$userID]);
    if (App::getLocale() == 'en')
    	return view('user.my-dashboard', compact('userNeeds', 'responseInfo'));
    else
    	return view('no.user.my-dashboard', compact('userNeeds', 'responseInfo'));
  }

  public function getDBInfoNeeds()
  {
    require(app_path('functions/convertIDToName.php'));
    //Get id of user
    $userID = Auth::user()->id;
    //Get information about request sent from this user
    $userNeeds = DB::select('SELECT * FROM user_needs WHERE user_id = ? ORDER BY created_at desc', [$userID]);
    //Get name from ID and replace array before sending back to user-view
    $userNeeds = convertIDToName($userNeeds);

    //$userInfo = DB::select('SELECT * FROM users WHERE id = ?', [$userID]);

    if (App::getLocale() == 'en')
    	return view('user.my-needs', compact('userNeeds'));
    else
    	return view('no.user.my-needs', compact('userNeeds'));
  }

  public function getDBInfoResponses()
  {
    require(app_path('functions/convertIDToName.php'));
    //Get id of user
    $userID = Auth::user()->id;

    //$userNeeds = DB::select('select * from user_needs where user_id = ?', [$userID]);
    //Get name from ID and replace array before sending back to user-view
    //$userNeeds = $this->convertIDToName($userNeeds);
    //Get information about responses and the company info
    $sql = 'SELECT ur.id, ur.akseptert, ur.ignorert, ur.userneed_id, ur.response_message, ur.created_at, cd.selskap,
                  cd.org_nummer, cs.mainservice_id, cs.secondaryservice_id, cs.timepris, cs.oppmøtepris,
                  cs.tilgjengelig, un.gyldig, un.befaring, un.antall_aksepterte_befaringer, cw.postnummer
            FROM user_responses ur, user_needs un, companies c, company_details cd, company_services cs, company_work_areas cw
            WHERE ur.user_id = ?
            AND c.id = ur.company_id
            AND cd.company_id = c.id
            AND cs.company_id = c.id
            AND cw.company_id = c.id
            AND cs.mainservice_id = un.mainservice_id
            AND cs.secondaryservice_id = un.secondaryservice_id
            AND un.id = ur.userneed_id
            AND ur.ignorert NOT IN (1)
            ORDER BY ur.userneed_id desc';
    $responseInfo = DB::select($sql, [$userID]);
    $responseInfo = convertIDToName($responseInfo);

    //$userInfo = DB::select('SELECT * FROM users WHERE id = ?', [$userID]);

    if (App::getLocale() == 'en')
    	return view('user.my-responses', compact('responseInfo'));
    else
    	return view('no.user.my-responses', compact('responseInfo'));
  }
}
