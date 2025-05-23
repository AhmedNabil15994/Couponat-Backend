<?php

namespace Modules\Offer\Transformers\Api;

use Illuminate\Http\Resources\Json\JsonResource;
use Modules\Offer\Entities\Offer;
use Modules\Offer\Repositories\Api\OfferRepository;
use Modules\User\Transformers\Api\UserResource;

class ShowOfferResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request
     * @return array
     */
    public function toArray($request)
    {
        $item = $this;
        $items = [];
        $extra = [
            'is_favorite' => false,
        ];

        if($request->offer_id){
            $item = $this->orderItems()->first()->offer;
            $offerItems = $this->orderItems()->where([['offer_id',$request->offer_id],['order_id',$this->id]]);
            $extra['qty'] = $offerItems->sum('qty');
            $qr = [];
            foreach ($offerItems->get() as $myItem){
                $qr[] = asset('/uploads/qr/'.$myItem->code.'.png');
                $items[] = [
                    'qr'    => asset('/uploads/qr/'.$myItem->code.'.png'),
                    'code'  => $myItem->code,
                    'discount_desc' => $myItem->offer->discount_desc,
                    'status'    =>  $myItem->expired_date < date('Y-m-d H:i:s') ? __('apps::frontend.expired') : __('apps::frontend.valid'),
                    'expired_at'    => $myItem->expired_date,
                    'is_redeemed' => $myItem->is_redeemed,
                    'redeemed_at' => $myItem->redeemed_at,
                ];
            }
            $extra['qr'] = $qr;
            $extra['items'] = $items;
        }

        $extra['related'] = Offer::getRelated($item);

        if(auth('sanctum')->check()){
            $extra['is_favorite'] = $item->is_favorite ? true : (\Request::segment(2) == 'auth' ? true : false);
        }

        $details = explode("\r\n",$item->details);
        $details[count($details)] = __('offer::frontend.offers.valid', ['from'=> date('d/m/Y',strtotime($item->user_valid_from??$item->start_at)) , 'to'=> date('d/m/Y',strtotime($item->user_valid_until))]);

        preg_match('/src="([^"]+)"/', $item->video, $match);

        $base = [
            'id'            => $item->id,
            'title'        => $item->title,
            'description'        => str_replace("\r\n"," <br> ", str_replace("\r\n"," \r\n ",$item->description)),
            'discount'        => $item->discount_desc,
            'discount_title'    => $item->discount_title,
            'quantity'       => $item->quantity,
            'is_sold_out'       => $item->quantity ? false : true,
            'seller'        => (new UserResource($item->seller))->jsonSerialize(),
            'state'        => $item->state?->title ?? '',
            'state_id'        => $item->state_id,
            'city'        => $item->city?->title ?? '',
            'city_id'       => $item->city_id,
            'category'        => $item->category?->title ?? '',
            'category_id'        => $item->category_id,
            'price'        => number_format($item->price,3) . ' ' . __('apps::frontend.kd'),
            'image' => $item->main_image,
            'gallery'    => [
                'images'        => $item->images_arr,
                'video'         => $match[1] ?? $item->video,
            ],
            'share_link'    => route('frontend.offers.show',['id' => $item->id]),
            'deep_share_links' => [
                'android'   => url('/.well-known/android-association.json'),
                'ios'       => url('/.well-known/ios-association.json'),
            ],
            'details'   => $details,
            'lat'       => $item->lat,
            'lng'       => $item->lng,
            'expired_at'        => date('d-m-Y' , strtotime($item->expired_at)),
            'created_at'    => date('d-m-Y' , strtotime($item->created_at)),
        ];
        return array_merge($base,$extra);
    }
}
