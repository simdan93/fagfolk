<?php

namespace Fagfolk;

use Illuminate\Database\Eloquent\Model;

class CompanyWorkArea extends Model
{
	protected $fillable = [
        'company_id', 'postnummer',
    ];

    /**
     * The attributes that should be hidden for arrays.
     */
    protected $hidden = [
    ];

    public function company()
    {
        return $this->belongsTo('App\CompanyDetail');
    }
}
