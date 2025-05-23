<?php

namespace Modules\Cart\Http\Controllers\Api;

use Cart;
use Illuminate\Http\Request;
use Modules\Apps\Http\Controllers\Api\ApiController;
use Modules\Cart\Traits\CartTrait;
use Modules\Cart\Transformers\Api\CartResource;
use Modules\Coupon\Http\Controllers\Api\CouponController;
use Modules\Coupon\Http\Requests\Api\CouponRequest;
use Modules\Offer\Entities\Offer;
use Modules\Offer\Repositories\Api\OfferRepository;
use Modules\Offer\Transformers\Api\OfferResource;
use Modules\User\Entities\User;

class CartController extends ApiController
{
    use CartTrait;

    protected $offer;
    protected $seller;

    public function __construct(OfferRepository $offer, User $seller)
    {
        $this->offer = $offer;
        $this->selelr = $seller;
    }

    public function index(Request $request)
    {
        if (is_null($request->user_token)) {
            return $this->error(__('apps::frontend.general.user_token_not_found'), [], 422);
        }
        return $this->response($this->responseData($request));
    }

    public function createOrUpdate(Request $request,$productId)
    {
        $type = 'offer';
        $userToken = $request->user_token ?? null;
        // check if product single OR variable (variant)
        $item = $this->getItem($productId, $type);

        if (is_null($item)) {
            return $this->error('offer not found', [], 422);
        }

        if($request->qty > $item['user_max_uses']){
            return $this->error("Sorry you can't request more than ".$item['user_max_uses'] ." item", [], 422);
        }


        $this->addToCart($item, $type, $request->qty ?? 1);

        if(isset($request->replace)){
            $this->removeItem($productId, $type);
            $this->addToCart($item, $type, $request->qty ?? 1);
        }

        $couponDiscount = $this->getCondition($request, 'coupon_discount');
        if (!is_null($couponDiscount)) {
            $couponCode = $couponDiscount->getAttributes()['coupon']->code ?? null;
            $request->merge(['code' => $couponCode]);
            $couponRequest = CouponRequest::createFrom($request);
            (new CouponController())->check_coupon($couponRequest);
//            $this->applyCouponOnCart($request->user_token, $couponCode);
        }

        return $this->response($this->responseData($request));
    }

    private function  getItem($id, $type)
    {
        try {
            switch($type){
                case 'offer':
                    $model = $this->offer->getOffer($id);
                    $item = !is_null($model) ? (new OfferResource($model))->jsonSerialize() : null;
                    break;
            }
            return $item;
        } catch (\Throwable $th) {

        }
    }
    public function remove(Request $request,$id)
    {
        $this->removeItem($id, 'offer');
        $items = $this->getCartContent();
        $couponDiscount = $this->getCondition($request, 'coupon_discount');
        if (!is_null($couponDiscount)) {
            $couponCode = $couponDiscount->getAttributes()['coupon']->code ?? null;
            $request->merge(['code' => $couponCode]);
            $couponRequest = CouponRequest::createFrom($request);
            (new CouponController())->check_coupon($couponRequest);
        }
        return $this->response($this->responseData($request));
    }


    public function clear(Request $request)
    {
        $this->clearCart();
        $items = $this->getCartContent();
        return $this->response([]);
    }

    public function removeCondition(Request $request, $name)
    {
        $check = $this->removeConditionByName($request, $name);
        return $this->response($this->responseData($request));
    }

    public function responseData($request)
    {
        $collections = collect($this->cartDetails($request));
        $data = $this->returnCustomResponse($request);

        $data['items'] = CartResource::collection($collections);
        $data['vendor'] = null;
        $data['coupon_value'] = null;

        $couponDiscount = $this->getCondition($request, 'coupon_discount');
        if (!is_null($couponDiscount)) {
            if (!is_null($this->getCartItemsCouponValue()) && $this->getCartItemsCouponValue() > 0) {
                $data['coupon_value'] = number_format($this->getCartItemsCouponValue(), 3);
            }
        }

        return $data;
    }

    protected function returnCustomResponse($request)
    {
        return [
            'conditions' => $this->getCartConditions($request),
            'subTotal' => number_format($this->cartSubTotal($request), 3),
            'total' => number_format($this->cartTotal($request), 3),
            'count' => $this->cartCount($request),
        ];
    }

}
