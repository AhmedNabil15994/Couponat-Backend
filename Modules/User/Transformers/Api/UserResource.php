<?php

namespace Modules\User\Transformers\Api;

use Illuminate\Http\Resources\Json\JsonResource;
use Modules\Company\Transformers\Api\CompanyResource;

class UserResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'id'            => $this->id,
            'name'          => $this->name,
            'email'         => $this->email,
            'code_verified'         => $this->code_verified,
            'is_verified'   => (boolean)$this->is_verified,
            'calling_code'         => $this->calling_code,
            'mobile'        => $this->mobile,
//            'gender'        => $this->gender == 1 ? __("apps::frontend.male") : ( $this->gender == 2 ? __("apps::frontend.female") : ''),
//            'birthday'        => date('d-m-Y' , strtotime($this->birthday)),
       ];
    }
}
