<?php

namespace Modules\Order\Transformers\Vendor;

use Illuminate\Http\Resources\Json\JsonResource;

class OfferSalesResource extends JsonResource
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
           'title'                => $this->title,
           'order_items_sum_total'                => ($this->order_items_sum_total ?? '0.000') . ' ' . __('apps::frontend.kd'),
           'order_items_count'         => $this->order_items_count ?? 0,
           'redeem_times'    => $this->order_items_sum_is_redeemed ?? 0,
           'unredeem_times'    => $this->order_items_count - ($this->order_items_sum_is_redeemed ?? 0),
       ];
    }
}
