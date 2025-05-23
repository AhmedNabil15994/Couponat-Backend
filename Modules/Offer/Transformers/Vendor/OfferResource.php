<?php

namespace Modules\Offer\Transformers\Vendor;

use Illuminate\Http\Resources\Json\JsonResource;

class OfferResource extends JsonResource
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
            'id'            => $this->id,
            'title'        => $this->title,
            'discount_title'        => $this->discount_title,
            'discount_desc'        => $this->discount_desc,
            'seller'        => $this->seller?->name ?? '',
            'seller_id'        => $this->seller?->name ?? '',
            'state'        => $this->state?->title ?? '',
            'state_id'        => $this->state?->title ?? '',
            'city'        => $this->city?->title ?? '',
            'city_id'        => $this->city?->title ?? '',
            'category'        => $this->category?->title ?? '',
            'price'        => $this->price,
            'user_max_uses' => $this->user_max_uses,
            'main_image' => $this->main_image,
            'status'        => $this->status,
            'category_id'        => $this->category_id,
            'expired_at'        => $this->expired_at,
            'deleted_at'    => $this->deleted_at,
            'created_at'    => date('d-m-Y' , strtotime($this->created_at)),
       ];
    }
}
