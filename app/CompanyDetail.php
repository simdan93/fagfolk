<?php

namespace Fagfolk;

use Illuminate\Database\Eloquent\Model;

class CompanyDetail extends Model
{
	protected $fillable = [
        'company_id', 'selskap', 'org_nummer', 'postnummer',
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
}
