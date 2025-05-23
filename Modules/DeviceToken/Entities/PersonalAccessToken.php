<?php


namespace Modules\DeviceToken\Entities;

use Carbon\Carbon;
use Laravel\Sanctum\PersonalAccessToken as SanctumPersonalAccessToken;

class PersonalAccessToken extends SanctumPersonalAccessToken
{
    protected $fillable = [
        'name',
        'token',
        'abilities',
        'os',
        'firebase_token',
    ];



    public function getLastUsedAttribute()
    {
        $response['label'] = '<i class="fa fa-circle text-red" style="color: red"></i>';

        if ($this->last_used_at):

            if ($this->last_used_at->diffInMinutes(Carbon::now()) <= 5)
                $response['label'] = '<i class="fa fa-circle text-green" style="color: green"></i>';

            $response['time'] = $this->last_used_at->locale(locale())->diffForHumans(Carbon::now());
        else:

            $response['time'] = __('devicetoken::dashboard.devices.message.not_defined');
        endif;

        return (object)$response;
    }

    public function tokenable()
    {
        return $this->morphTo();
    }
}
