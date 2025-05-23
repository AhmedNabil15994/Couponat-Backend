<?php

namespace Modules\Cart\Transformers\Api;

use Illuminate\Http\Resources\Json\JsonResource;
use IlluminateAgnostic\Collection\Support\Carbon;
use Modules\Offer\Entities\Offer;

class CartResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request
     * @return array
     */
    public function toArray($request)
    {
        $mainOffer = Offer::find(str_replace('-offer','',$this['id']));
         return [
            'id' => $this['id'],
            'name' => $mainOffer?->title,
            'quantity'  => $this['quantity'],
            'price' => number_format($this['price'],3),
            'attributes' => [
                'item_id' => $this['attributes']['item_id'],
                'type' => $this['attributes']['type'],
                'image' => $this['attributes']['image'],
                'discount' => $this['attributes']['product']['discount']['desc'][locale()] ?? $this['attributes']['product']['discount'] ,
                'category' => $this['attributes']['product']['category'],
            ],
        ];
    }
}
