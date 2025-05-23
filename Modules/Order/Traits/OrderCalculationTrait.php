<?php

namespace Modules\Order\Traits;

use Modules\Cart\Traits\CartTrait;
use Modules\Course\Entities\Course;
use Modules\Course\Entities\Note;
use Modules\Offer\Entities\Offer;
use Modules\Package\Entities\Package;
use Modules\Package\Entities\PackagePrice;

trait OrderCalculationTrait
{
    use CartTrait;

    public function calculateTheOrder($request)
    {
        $cart = $this->getCartContent();

        $subtotal = 0.000;
        $total = 0.000;

        $coupon = null;
        $offers = [];


        if (!is_null($this->getCondition($request, 'coupon_discount'))) {
            $couponCondition = $this->getCondition($request, 'coupon_discount');
            $coupon['id'] = $couponCondition->getAttributes()['coupon']->id;
            $coupon['code'] = $couponCondition->getAttributes()['coupon']->code;
            $coupon['type'] = $couponCondition->getAttributes()['coupon']->discount_type;
            $coupon['discount_value'] = $couponCondition->getAttributes()['coupon']->discount_value ?? $couponCondition->getValue();
            $coupon['discount_percentage'] = $couponCondition->getAttributes()['coupon']->discount_percentage;
        }

        foreach ($cart as $key => $item) {
            switch($item['attributes']['type']){
                case 'offer':
                    $orderOffers['offer'] = Offer::find($item['attributes']['item_id']);
                    $orderOffers['price'] = $orderOffers['offer']['price'];
                    $orderOffers['total'] = $item['price'];
                    $orderOffers['quantity'] = $item['quantity'];

                    $subtotal += $orderOffers['total'] * $orderOffers['quantity'];
                    $total += $orderOffers['total'] * $orderOffers['quantity'];
                    $offers[] = $orderOffers;
                    break;
            }
        }
        return [
            'subtotal' => $this->cartSubTotal(['user_token'=>$this->userToken()]),
            'total' => $this->cartTotal(['user_token'=>$this->userToken()]),
            'discount'  => isset($coupon['discount_value']) ? floatval($coupon['discount_value']) : 0,
            'coupon' => $coupon,
            'order_offers' => $offers,
        ];
    }
}
