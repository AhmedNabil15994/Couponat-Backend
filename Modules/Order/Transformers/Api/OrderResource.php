<?php

namespace Modules\Order\Transformers\Api;

use Modules\Vendor\Transformers\Api\VendorResource;
use Illuminate\Http\Resources\Json\JsonResource;

class OrderResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'id'                 => $this->id,
            'user_id'           => $this->user_id,
           'subtotal'           => $this->subtotal,
           'discount'           => $this->discount,
           'total'              => $this->total,
           'items'             => OrderProductResource::collection($this->orderItems()->groupBy('offer_id')->get() ?? []),
           'order_status'       => $this->orderStatus->title,
           'created_at'         => date('d-m-Y H:i A' , strtotime($this->created_at)),
       ];
    }
}
