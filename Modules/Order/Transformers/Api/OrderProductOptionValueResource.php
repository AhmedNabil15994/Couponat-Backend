<?php

namespace Modules\Order\Transformers\Api;

use Illuminate\Http\Resources\Json\JsonResource;

class OrderProductOptionValueResource extends JsonResource
{
    public function toArray($request)
    {
        return [
           'id'                => $this->id,
           'value'             => $this->optionValue->translate(locale())->title,
       ];
    }
}
