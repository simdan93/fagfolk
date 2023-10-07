<?php

namespace Fagfolk;

use Illuminate\Database\Eloquent\Model;

class CompanyService extends Model
{
	protected $fillable = [
        'company_id', 'mainservice_id', 'secondaryservice_id', 'timepris', 'oppmøtepris', //'tilgjengelig',
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
