<?php

namespace Fagfolk;

use Illuminate\Database\Eloquent\Model;

class UserHomeAddress extends Model
{
	protected $fillable = [
        'user_id', 'addresse', 'postnummer', 'sted',
    ];
    
    protected $hidden = [
        'user_id',
    ];
    
    public function user_home_addresse()
    {
        return $this->belongsToMany('App\User');
    }
}
