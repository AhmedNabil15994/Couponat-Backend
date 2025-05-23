<?php

namespace Modules\Offer\Transformers\Api;

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
        $extra = [];
        if(auth('sanctum')->check()){
            $extra = [
                'is_favorite'   => $this->is_favorite ? true : (\Request::segment(2) == 'auth' ? true : false)
            ];
        }
        $details = explode("\r\n",$this->details);
        $details[count($details)] = __('offer::frontend.offers.valid', ['from'=> date('d/m/Y',strtotime($this->user_valid_from??$this->start_at)) , 'to'=> date('d/m/Y',strtotime($this->user_valid_until))]);

        $base = [
            'id'            => $this->id,
            'title'        => $this->title,
            'description'        => str_replace("\r\n"," <br> ", str_replace("\r\n"," \r\n ",$this->description)),
            'discount'        => $this->discount_desc,
            'discount_title'    => $this->discount_title,

            'quantity'       => $this->quantity,
            'is_sold_out'       => $this->quantity ? false : true,
            'seller'        => $this->seller?->name ?? '',
            'seller_mobile'        => $this->seller?->mobile ?? '',
            'state'        => $this->state?->title ?? '',
            'city'        => $this->city?->title ?? '',
            'category'        => $this->category?->title ?? '',
            'price'        => number_format($this->price,3) . ' ' . __('apps::frontend.kd'),
            'user_max_uses' => $this->user_max_uses,
            'image'     => $this->main_image,
            'lat'       => $this->lat,
            'lng'       => $this->lng,
            'details'   => $details,
            'category_id'        => $this->category_id,
            'expired_at'        => date('d-m-Y' , strtotime($this->expired_at)),
            'created_at'    => date('d-m-Y' , strtotime($this->created_at)),
        ];
        return array_merge($base,$extra);
    }
}
