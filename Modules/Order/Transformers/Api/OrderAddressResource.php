<?php

namespace Modules\Order\Transformers\Api;

use Illuminate\Http\Resources\Json\JsonResource;

class OrderAddressResource extends JsonResource
{
    public function toArray($request)
    {
        return [
           'id'                 => $this->id,
           'email'              => $this->email,
           'username'           => $this->username,
           'mobile'             => $this->mobile,
           'floor'              => $this->floor,
           'door'               => $this->door,
           'street'             => $this->street,
           'building'           => $this->building,
           'address'            => $this->address,
           'area_id'            => $this->area_id,
           'area'               => $this->area->translate(locale())->title,
       ];
    }
}
