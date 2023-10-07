<?php

namespace Fagfolk;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Fagfolk\Notifications\No\UserResetPasswordNotification as ResetPasswordNotification;

class User extends Authenticatable
{
    use Notifiable;
    
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'navn', 'etternavn', 'alder', 'telefon', 'mobil', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];
    
    public function sendPasswordResetNotification($token)
    {
        $this->notify(new ResetPasswordNotification($token));
    }
    
    public function user_home_address(){
        return $this->hasOne('App\UserHomeAddress');
    }
    public function user_pay_address(){
        return $this->hasOne('App\UserPayAddress');
    }
    public function user_needs(){
        return $this->hasMany('App\UserNeed');
    }
    
}
