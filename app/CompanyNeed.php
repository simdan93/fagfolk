<?php

namespace Fagfolk;

use Illuminate\Database\Eloquent\Model;

class CompanyNeed extends Model
{
	protected $fillable = [
        'req_company_id', 'mainservice_id', 'secondaryservice_id','postnummer', 'tilgjengelig','beskrivelse', 'oppsummering', 'befaring',
    ];

    /**
     * The attributes that should be hidden for arrays.
     */
    protected $hidden = [
    ];

    public function company()
    {
        return $this->belongsTo('App\Company');
    }
    public function main_service()
    {
        return $this->belongsTo('App\MainService');
    }
    public function secondary_service()
    {
        return $this->belongsTo('App\SecondaryService');
    }
}
