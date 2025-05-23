<?php

namespace Modules\Offer\Repositories\Api;

use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Modules\Category\Entities\Category;
use Modules\Offer\Entities\Offer;

class OfferRepository
{

    public function __construct(Offer $offer)
    {
        $this->offer = $offer;
    }

    public function getAll($request){
        $query = $this->offer->active();

        if(isset($request->category_id) && !empty($request->category_id) ){
            $query = $query->whereHas('offersCategories',function ($q) use ($request){
                $q->where('category_id',$request->category_id);
            });
        }

        $query = $query->where(function ($q) use ($request){
                if (isset($request->search) && !empty($request->search)) {
                    $q->where(DB::raw('lower(title)'),'LIKE','%'.strtolower($request->search).'%')
                        ->orWhere(DB::raw('lower(discount_desc)'),'LIKE','%'.strtolower($request->search).'%');
                }
                if(isset($request->city_id) && !empty($request->city_id)){
                    $q->where('city_id',$request->city_id);
                }

                if(isset($request->state_id) && !empty($request->state_id)){
                    $q->where('state_id',$request->state_id);
                }

            })
            ->where('expired_at','>',Carbon::now())
            ->where('start_at','<=',Carbon::now())
            ->when(auth('sanctum')->user(), fn($query) => $query->isFavourite(auth('sanctum')->id()));

//        if(isset($request->is_favorite) && $request->is_favorite){
//            $query = $query->whereHas('userFavorites',function ($where){
//                $where->where('user_id',auth('sanctum')->id());
//            });
//        }

        if(isset($request->is_my_coupons) && $request->is_my_coupons){
            $query = $query->whereHas('orderItems',function ($where){
                $where->whereUserId(auth('sanctum')->id())
                    ->notExpired()
                    ->successPay();
            });
        }
        return $query->orderBy('order','desc')->paginate(env('PAGINATION_COUNT'));
    }

    public function getOffer($id){
        $id = (int) $id;
        return  $this->offer->active()->when(!auth()->check(),function ($query){
            $query->where('expired_at','>',Carbon::now())->where('start_at','<=',Carbon::now());
        })->when(auth()->check(), function ($query){
            $query->isFavourite(auth()->id());
        })->find($id);
    }

    public function getByCategory($category_id,$id=null){
        return $this->offer->whereIn('id',$category_id)->where('expired_at','>',Carbon::now())
            ->where('start_at','<=',Carbon::now())->where('quantity','>=',1)->orderBy('order','desc')->get();
    }

    public function userOffers(){
        return $this->offer
            ->when(auth()->check(), fn ($q) => $q->subscribed(auth()->id()))
            ->withCount('orderItems')
            ->whereHas(
                'orderItems',
                fn ($q) => $q
                    ->whereUserId(auth()->id())
                    ->notExpired()
                    ->successPay()
            )->orderBy('order','desc')->get();
    }

    public function getActiveRelated($id) {
        return $this->offer->active()->where('id','!=',$id)
            ->where('expired_at','>',Carbon::now())
            ->where('start_at','<=',Carbon::now())
            ->when(auth()->check(), fn($query) => $query->isFavourite(auth()->id()))
            ->orderBy('order','desc')->orderBy('id','asc')->paginate(env('PAGINATION_COUNT'));
    }
}
