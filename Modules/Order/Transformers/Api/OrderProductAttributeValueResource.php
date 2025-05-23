<?php

namespace Modules\Order\Transformers\Api;

use Illuminate\Http\Resources\Json\JsonResource;

class OrderProductAttributeValueResource extends JsonResource
{
    public function toArray($request)
    {
        return [
           'id'                => $this->id,
           'value'             => $this->attributeValue->translate(locale())->title,
           'price'             => $this->price,
           'qty'               => $this->qty,
           'total'             => $this->total,
       ];
    }
}
