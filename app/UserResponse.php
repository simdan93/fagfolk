<?php

namespace Fagfolk;

use Illuminate\Database\Eloquent\Model;

class UserResponse extends Model
{
	protected $fillable = [
        'user_id', 'company_id', 'userneed_id', 'akseptert', 'ignorert', 'response_message',
    ];
    
    protected $hidden = [
    ];
    
    public function company_response()
    {
        return $this->belongsTo('App\Company');
    }
    
    public function user_response()
    {
        return $this->belongsTo('App\User');
    }
    
    public function user_need_response()
    {
        return $this->belongsTo('App\UserNeed');
    }
}
