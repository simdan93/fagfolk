<?php

namespace Fagfolk;

use Illuminate\Database\Eloquent\Model;

class MainService extends Model
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
    public function secondary_services(){
        return $this->hasMany('App\SecondaryServices');
    }
}
