<?php

namespace Modules\Offer\Http\Controllers\Api;

use Carbon\Carbon;
use Cart;
use Darryldecode\Cart\CartCondition;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Modules\Apps\Http\Controllers\Api\ApiController;
use Modules\Apps\Http\Controllers\WebService\WebServiceController;
use Modules\Cart\Traits\CartTrait;
use Modules\Catalog\Entities\Product;
use Modules\Coupon\Entities\Coupon;
use Modules\Offer\Entities\Offer;
use Modules\Offer\Repositories\Api\OfferRepository;
use Modules\Offer\Transformers\Api\OfferResource;
use Modules\Offer\Transformers\Api\ShowOfferResource;
use Modules\Order\Entities\OrderCoupon;

// use Modules\Coupon\Http\Requests\WebService\CouponRequest;

class OfferController extends ApiController
{
    public function __construct(OfferRepository $offer)
    {
        $this->offer = $offer;
    }
    public function index(Request $request) {
        $offers = $this->offer->getAll($request);
        return $this->responsePaginationWithData(OfferResource::collection($offers));
    }

    public function show(Request $request,$id) {
        $offer   = $this->offer->getOffer($id);
        if(!$offer){
            return $this->error(__('offer::api.invalid_offer'));
        }

        $ids = [];
        foreach ($offer->categories as $category){
            $data = $category->offers()->where('offer_id','!=',$id)->pluck('offer_id')->toArray();
            $ids = array_merge($ids,$data);
        }
        $related = Offer::getRelated($offer);
        $related = count($related) ? $related : $this->offer->getActiveRelated($id);
        $data = (new ShowOfferResource($offer))->jsonSerialize();
        $data['related'] = OfferResource::collection($related);

        return $this->response($data);
    }
}
