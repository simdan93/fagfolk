<?php

namespace Fagfolk\Http\Controllers;

use Illuminate\Http\Request;
use Intervention\Image\ImageManagerStatic as Image;
use Fagfolk\Profile;

use Auth;
use DB;
use Log;
use File;

class ProfileController extends Controller
{
  public function __construct()
  {
    $this->middleware('auth:company');
  }
  /**
   * Display a listing of the resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function index()
  {
      //
  }

  public function showProfile()
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

    //Download a Test picture
    $imagesForCompany = DB::select('SELECT * FROM profiles WHERE company_id = ?', [$myCompanyID]);
    $companyWorkAreas = DB::select('SELECT * FROM company_work_areas WHERE company_id = ?', [$myCompanyID]);

    return view('no.company.profile.my_profile', compact('companyDetails', 'companyDetailsExists', 'companyServices', 'companyInfo', 'payAdress', 'officeAdress', 'imagesForCompany', 'companyWorkAreas'));
  }

  /**
   * Store a newly created resource in storage.
   *
   * @param  \Illuminate\Http\Request  $request
   * @return \Illuminate\Http\Response
   */
  public function uploadImages(Request $request)
  {
    $myCompanyID = Auth::user()->id;
    $this->validate($request, [
      'filename' => 'required',
      'filename.*' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048'
    ]);

    if($request->hasfile('filename'))
    {
      foreach($request->file('filename') as $image)
      {
        $name=$image->getClientOriginalName();

        $image_resize = Image::make($image->getRealPath());
        //$image_resize->resize(300, 250);
        if (! File::exists(public_path()."/images/company_". $myCompanyID)) {
            File::makeDirectory(public_path()."/images/company_". $myCompanyID);
        }
        $image_resize->save(public_path('/images/company_' . $myCompanyID . '/'. $name));
        //$image_resize->move(public_path().'/images/company_' . $myCompanyID . '/', $name);
        $this->create($name);
      }
    }
    return redirect()->intended(route('company.profile'))->with('success', 'Your images has been successfully uploaded');
  }

  protected function create($name)
  {
      return Profile::create([
        'filename' => $name,
        'company_id' => Auth::user()->id,
      ]);
  }

  /**
   * Remove the specified resource from storage.
   *
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function deleteImages()
  {
    if( isset($_POST['image']) && is_array($_POST['image']) ) {
      foreach($_POST['image'] as $imageID) {
        $imageReferenced = DB::select('SELECT * FROM profiles WHERE id = ?', [$imageID]);
        //Delete reference from database
        DB::delete('DELETE FROM profiles WHERE id = ?', [$imageID]);
        //Delete from server storage
        $image_path = public_path() . '/images/' . $imageReferenced[0]->filename;  // Value is not URL but directory file path
        if(File::exists($image_path)) {
          File::delete($image_path);
        }
      }
    }
    return redirect()->intended(route('company.profile'));
  }
  /**
   * Display the specified resource.
   *
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function show($id)
  {
      //
  }

  /**
   * Show the form for editing the specified resource.
   *
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function edit($id)
  {
      //
  }

  /**
   * Update the specified resource in storage.
   *
   * @param  \Illuminate\Http\Request  $request
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function update(Request $request, $id)
  {
      //
  }
}
