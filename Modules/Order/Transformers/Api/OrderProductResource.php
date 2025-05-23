<?php

namespace Modules\Order\Transformers\Api;

use Illuminate\Http\Resources\Json\JsonResource;
use Modules\Offer\Transformers\Api\OfferResource;

class OrderProductResource extends JsonResource
{
    public function toArray($request)
    {
        $offerItems = $this->where([['offer_id',$this->offer_id],['order_id',$this->order_id]]);
        $qty = $offerItems->sum('qty');
        $codes = $offerItems->get();
        $qr = [];
        foreach ($codes as $myItem){
            if(!file_exists(public_path('/uploads/qr/'.$myItem->code.'.png'))){
                $filename_path = $myItem->code.".png";
                $decoded = base64_decode(base64_encode(\QrCode::format('png')->size(100)->generate(route('vendor.home').'?code='.$myItem->code )));
                file_put_contents(public_path('/uploads/qr/').$filename_path,$decoded);
            }
            $qr[] = [
                'qr'    => asset('/uploads/qr/'.$myItem->code.'.png'),
                'code'  => $myItem->code,
                'discount_desc' => $myItem->offer->discount_desc,
                'status'    =>  $myItem->expired_date < date('Y-m-d H:i:s') ? __('apps::frontend.expired') : __('apps::frontend.valid'),
                'expired_at'    => $myItem->expired_date,
                'is_redeemed' => (boolean)$myItem->is_redeemed,
                'redeemed_at' => $myItem->redeemed_at,
            ];

        }
        return [
            'offer'              => (new OfferResource($this->offer))->jsonSerialize(),
            'qty'                => $qty,
            'total'              => number_format($this->total * $qty , 3),
            'expired_at'         => date('d-m-Y' , strtotime($this->expired_date)),
            'expired'            => $this->expired_date > date('Y-m-d') ? false : true,
            'order_id'           => $this->order_id,
            'items'                 => $qr,
       ];
    }
}
