<?php

namespace Fagfolk;

use Illuminate\Database\Eloquent\Model;

class CompanyPayAdress extends Model
{
	protected $fillable = [
        'company_id', 'faktura_addresse', 'faktura_postnummer', 'faktura_by',
    ];

    protected $hidden = [
        'company_id',
    ];
    public function company_pay_adresse()
    {
        return $this->belongsToMany('App\Company');
    }
}
