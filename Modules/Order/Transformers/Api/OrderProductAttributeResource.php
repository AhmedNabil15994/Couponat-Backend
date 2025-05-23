<?php

namespace Modules\Order\Transformers\Api;

use Illuminate\Http\Resources\Json\JsonResource;

class OrderProductAttributeResource extends JsonResource
{
    public function toArray($request)
    {
        return [
           'id'                 => $this->id,
           'attribute'          => $this->attribute->translate(locale())->title,
           'attribute_value'    => OrderProductAttributeValueResource::collection($this->orderProductAttributeValues)
       ];
    }
}
