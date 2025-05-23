<?php

namespace Modules\Order\Transformers\Vendor;

use Illuminate\Http\Resources\Json\JsonResource;

class VenderSalesResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request
     * @return array
     */
    public function toArray($request)
    {
        return [
           'id'                   => $this->id,
           'name'                 => $this->name,
           'seller_order_items_sum_total'                => ($this->seller_order_items_sum_total ?? '0.000') . ' ' . __('apps::frontend.kd'),
           'seller_order_items_count'         => $this->seller_order_items_count ?? 0,
       ];
    }
}
