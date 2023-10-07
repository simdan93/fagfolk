<?php

namespace Fagfolk;

use Illuminate\Database\Eloquent\Model;

class CompanyResponse extends Model
{
	protected $fillable = [
        'req_company_id', 'company_id', 'companyneed_id', 'akseptert', 'ignorert', 'response_message',
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
    
    public function company_need_response()
    {
        return $this->belongsTo('App\CompanyNeed');
    }
}
