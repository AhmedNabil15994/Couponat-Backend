<?php

namespace Modules\Order\Entities;

use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;
use Modules\Area\Entities\State;
use Modules\Core\Traits\ScopesTrait;

class Address extends Model
{
    use ScopesTrait;

    protected $fillable = [
        'address',
        'mobile',
        'type',
        'street',
        'building',
        'city',
        'region',
        'street',
        'gada',
        'widget',
        'state_id',
        'user_id',
        'floor',
        'flat',
        'details'
    ];

    public function user()
    {
        return $this->belongsTo(\Modules\User\Entities\User::class);
    }

    public function state()
    {
        return $this->belongsTo(State::class);
    }

    public function orders()
    {
        return $this->hasMany(Order::class);
    }
}
