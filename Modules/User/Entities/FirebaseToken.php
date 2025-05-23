<?php

namespace Modules\User\Entities;

use Illuminate\Database\Eloquent\Model;

class FirebaseToken extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id', 'user_id', 'firebase_token', 'device_type','lang'
    ];

    const DEVICE_TYPES = [
        'android' => 1,
        'ios' => 2,
        'web' => 3,
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
