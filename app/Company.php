<?php

namespace Fagfolk;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Fagfolk\Notifications\No\CompanyResetPasswordNotification as ResetPasswordNotification;

class Company extends Authenticatable
{
    use Notifiable;

    protected $guard = 'company';

    /**
     * The attributes that are mass assignable.
     */
    protected $fillable = [
       'navn', 'etternavn', 'mobil', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function sendPasswordResetNotification($token)
    {
        $this->notify(new ResetPasswordNotification($token));
    }

    public function details(){
        return $this->hasOne('App\CompanyDetail');
    }
    public function company_needs(){
        return $this->hasMany('App\CompanyNeed');
    }
    public function company_services(){
        return $this->hasMany('App\CompanyService');
    }
}
