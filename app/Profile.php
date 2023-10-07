<?php

namespace Fagfolk;

use Illuminate\Database\Eloquent\Model;

class Profile extends Model
{
  protected $fillable = [
      'filename', 'company_id',
  ];
}
