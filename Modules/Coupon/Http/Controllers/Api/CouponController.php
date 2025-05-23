<?php

namespace Modules\Coupon\Http\Controllers\Api;

use Carbon\Carbon;
use Cart;
use Darryldecode\Cart\CartCondition;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Modules\Apps\Http\Controllers\Api\ApiController;
use Modules\Apps\Http\Controllers\WebService\WebServiceController;
use Modules\Cart\Traits\CartTrait;
use Modules\Catalog\Entities\Product;
use Modules\Coupon\Entities\Coupon;
use Modules\Coupon\Http\Requests\Api\CouponRequest;

class CouponController extends ApiController
{
    use CartTrait;

    public function checkCouponOld(CouponRequest $request)
    {
        if ($this->getCartSubTotal($request->user_token) <= 0)
            return $this->error(__('coupon::api.coupons.validation.cart_is_empty'), [], 401);

        $coupon = Coupon::where('code', $request->code)->active()->first();
        if ($coupon) {
            if ($coupon->start_at > Carbon::now()->format('Y-m-d') || $coupon->expired_at < Carbon::now()->format('Y-m-d'))
                return $this->error(__('coupon::api.coupons.validation.code.expired'), [], 401);

            // Check if coupon is used before by this user
            $couponCondition = getCartConditionByName($request->user_token, 'coupon_discount');

            if (!is_null($couponCondition))
                return $this->error(__('coupon::api.coupons.validation.coupon_is_used'), [], 401);

            $discount_value = 0;
            if ($coupon->discount_type == "value")
                $discount_value = $coupon->discount_value;
            elseif ($coupon->discount_type == "percentage") {
                $discount_percentage_value = (getCartSubTotal($request->user_token) * $coupon->discount_percentage) / 100;

                if ($discount_percentage_value > $coupon->max_discount_percentage_value)
                    $discount_value = $coupon->max_discount_percentage_value;
                else
                    $discount_value = $discount_percentage_value;
            }

            // $subTotal = getCartSubTotal($request->user_token) - $discount_value;
            // Save Coupon Discount Condition
            $resultCheck = $this->discountCouponCondition($coupon, $discount_value, $request);
            if (!$resultCheck)
                return $this->error(__('coupon::api.coupons.validation.condition_error'), [], 401);

            $data = [
                'discount_value' => $discount_value,
                'subTotal' => $this->cartSubTotal($request),
                'total' => $this->cartTotal($request),
            ];
            return $this->response($data);
        } else {
            return $this->error(__('coupon::api.coupons.validation.code.not_found'), [], 401);
        }
    }

    /*
     *** Start - Check Api Coupon
     */
    public function check_coupon(CouponRequest $request)
    {
        if ($this->cartSubTotal($request) <= 0)
            return $this->error(__('coupon::api.coupons.validation.cart_is_empty'), [], 401);

        $coupon = Coupon::where('code', $request->code)->active()->first();
        if ($coupon) {

            if ($coupon->start_at > Carbon::now()->format('Y-m-d') /*|| $coupon->expired_at < Carbon::now()->format('Y-m-d')*/)
                return $this->error(__('coupon::api.coupons.validation.code.expired'), [], 401);


            // Remove Old General Coupon Condition
            $this->removeConditionByName( $request,'coupon_discount');
            $userToken = $request->user_token;

            $cartItems = $this->getCartContent($request->user_token);

            $conditionValue = $this->addProductCouponCondition($request,$cartItems, $coupon, $userToken, []);
            $data = [
                'discount_value' => $conditionValue > 0 ? number_format($conditionValue, 2) : 0,
                'subTotal' => number_format($this->cartSubTotal($request), 2),
                'total' => number_format($this->cartTotal($request), 2),
            ];

            return $this->response($data);
        } else {
            return $this->error(__('coupon::api.coupons.validation.code.not_found'), [], 401);
        }
    }

    protected function getProductsList($coupon, $flag = 'products')
    {
        $coupon_vendors = $coupon->vendors ? $coupon->vendors->pluck('id')->toArray() : [];
        $coupon_products = $coupon->products ? $coupon->products->pluck('id')->toArray() : [];
        $coupon_categories = $coupon->categories ? $coupon->categories->pluck('id')->toArray() : [];

        $products = Product::where('status', true);

        if ($flag == 'products') {
            $products = $products->whereIn('id', $coupon_products);
        }

        $products = $products->whereHas('vendor', function ($query) use ($coupon_vendors, $flag) {
            if ($flag == 'vendors') {
                $query->whereIn('id', $coupon_vendors);
            }
            $query->active();
            $query->whereHas('subbscription', function ($q) {
                $q->active()->unexpired()->started();
            });
        });

        if ($flag == 'categories') {
            $products = $products->whereHas('categories', function ($query) use ($coupon_categories) {
                $query->active();
                $query->whereIn('product_categories.category_id', $coupon_categories);
            });
        }

        return $products->get(['id']);
    }

    private function addProductCouponCondition($request,$cartItems, $coupon, $userToken, $prdListIds = [])
    {
        $totalValue = 0;
        $discount_value = 0;

        foreach ($cartItems as $cartItem) {

            if ($cartItem->attributes->type == 'offer') {
                $prdId = $cartItem->attributes->product['id'];
                $cartKey = $cartItem->id;
            } else {
                $prdId = $cartItem->attributes->product->product->id;
                $cartKey = $cartItem->id;
            }

            // Remove Old Condition On Product
            $this->removeConditionByName($request, 'product_coupon');

            if ($coupon->discount_type == "value") {
                $discount_value = $coupon->discount_value;
                $totalValue += intval($cartItem->quantity) * $discount_value;
            } elseif ($coupon->discount_type == "percentage") {
                $discount_value = (floatval($cartItem->price) * $coupon->discount_percentage) / 100;
                $totalValue += $discount_value * intval($cartItem->quantity);
            }

            $prdCoupon = new CartCondition(array(
                'name' => 'product_coupon',
                'type' => 'product_coupon',
                'value' => number_format($discount_value * -1, 2),
            ));

            Cart::session($userToken)->addItemCondition($cartKey,$prdCoupon);
        }

        $this->saveEmptyDiscountCouponCondition($coupon, $userToken,$totalValue); // to use it to check coupon in order
        return $totalValue;
    }

    /*
     *** End - Check Api Coupon
     */

}
