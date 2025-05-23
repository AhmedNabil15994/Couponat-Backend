<?php

namespace Modules\Order\Transformers\Api;

use Illuminate\Http\Resources\Json\JsonResource;

class OrderProductOptionResource extends JsonResource
{
    public function toArray($request)
    {
        return [
           'id'                 => $this->id,
           'option'             => $this->option->translate(locale())->title,
           'option_value'       => new OrderProductOptionValueResource($this->orderProductOptionValues)
       ];
    }
}
