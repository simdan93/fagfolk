<?php

namespace Fagfolk;

use Illuminate\Database\Eloquent\Model;

class SecondaryService extends Model
{
	public function company_needs(){
		return $this->hasMany('App\CompanyNeed');
	}
	public function company_services(){
		return $this->hasMany('App\CompanyService');
	}
	public function user_needs(){
		return $this->hasMany('App\UserNeed');
	}
	
	public function main_service(){
		return $this->belongsTo('App\MainService');
	}
}
