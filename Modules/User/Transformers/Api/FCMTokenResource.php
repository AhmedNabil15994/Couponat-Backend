<?php

namespace Modules\User\Transformers\Api;

use Illuminate\Http\Resources\Json\JsonResource;
use Modules\Company\Transformers\Api\CompanyResource;
use Modules\Level\Transformers\Api\LevelResource;

class FCMTokenResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'id'             => $this->id,
            'user_id'        => $this->user_id,
            'firebase_token' => $this->firebase_token,
            'device_type'    => $this->device_type,
            'lang'           => $this->lang,
       ];
    }
}
