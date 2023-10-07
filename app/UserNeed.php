<?php

namespace Fagfolk;

use Illuminate\Database\Eloquent\Model;

class UserNeed extends Model
{
	protected $fillable = [
        'user_id', 'mainservice_id', 'secondaryservice_id', 'postnummer', 'tilgjengelig', 'beskrivelse', 'oppsummering','befaring',
    ];

    protected $hidden = [
        'user_id',
    ];

    public function user_needs()
    {
        return $this->belongsTo('App\User');
    }
    public function main_services_needed()
    {
        return $this->belongsTo('App\MainService');
    }
    public function secondary_services_needed()
    {
        return $this->belongsTo('App\SecondaryService');
    }
}
