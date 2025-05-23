<?php

namespace Modules\Order\Transformers\Api;

use Illuminate\Http\Resources\Json\JsonResource;

class OrderRateResource extends JsonResource
{
    public function toArray($request)
    {
        return [
           'id'                 => $this->id,
           'order_rate'         => $this->order_rate,
           'service_rate'       => $this->service_rate,
           'delivery_rate'      => $this->delivery_rate,
           'vendor_rate'        => $this->vendor_rate,
       ];
    }
}
