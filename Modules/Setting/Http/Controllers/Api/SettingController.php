<?php

namespace Modules\Setting\Http\Controllers\Api;

use Illuminate\Http\Request;
use Modules\Apps\Http\Controllers\Api\ApiController;

class SettingController extends ApiController
{
    public function settings()
    {
        $settings =  config('api_setting');
        $reasons = [];
        if(setting('account_deletion')){
            foreach(json_decode(setting('account_deletion')) as $reason){
                $reasons[]=$reason->value;
            }
        }
        $settings['currency']   = __('apps::frontend.kd');
        $settings['account_deletion_reasons'] = $reasons;
        return $this->response($settings);
    }

}
