<?php

namespace Modules\Authentication\Entities;

use Illuminate\Database\Eloquent\Model;
use IlluminateAgnostic\Arr\Support\Carbon;

class OtpRequest extends Model
{
    protected $fillable = ['otp', 'mobile'];
    

    public function getIsExpiredAttribute()
    {
        return Carbon::now()->gte(Carbon::parse($this->updated_at)->addMinutes(5));
    }
}
