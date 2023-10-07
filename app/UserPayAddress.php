<?php

namespace Fagfolk;

use Illuminate\Database\Eloquent\Model;

class UserPayAddress extends Model
{
	protected $fillable = [
        'user_id', 'faktura_addresse', 'faktura_postnummer', 'faktura_by',
    ];
    
    protected $hidden = [
        'user_id',
    ];
    public function user_pay_addresse()
    {
        return $this->belongsToMany('App\User');
    }
}
