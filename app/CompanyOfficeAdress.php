<?php

namespace Fagfolk;

use Illuminate\Database\Eloquent\Model;

class CompanyOfficeAdress extends Model
{
	protected $fillable = [
        'company_id', 'kontor_addresse', 'kontor_postnummer', 'kontor_by',
    ];

    protected $hidden = [
        'company_id',
    ];

    public function company_office_adresse()
    {
        return $this->belongsToMany('App\Company');
    }
}
