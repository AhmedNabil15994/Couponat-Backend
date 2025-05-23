<?php

namespace Modules\Offer\Repositories\Frontend;

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
        return $this->offer->active()->where(function ($q) use ($request){
            if(isset($request->search) && !empty($request->search)){
                $q->where(DB::raw('lower(title)'),'LIKE','%'.strtolower($request->search).'%')
                    ->orWhere(DB::raw('lower(discount_desc)'),'LIKE','%'.strtolower($request->search).'%');
            }
            if(isset($request->city_id) && !empty($request->city_id)){
                $q->whereIn('city_id',$request->city_id);
            }
        })
            ->where('expired_at','>',Carbon::now())
            ->where('start_at','<=',Carbon::now())
        ->when(auth()->check(), fn($query) => $query->isFavourite(auth()->id()))
        ->orderBy('order','desc')->paginate(env('PAGINATION_COUNT'));
    }

    public function getActiveRelated($id) {
        return $this->offer->active()->where('id','!=',$id)
            ->where('expired_at','>',Carbon::now())
            ->where('start_at','<=',Carbon::now())
            ->when(auth()->check(), fn($query) => $query->isFavourite(auth()->id()))
            ->orderBy('order','desc')->paginate(env('PAGINATION_COUNT'));
    }

    public function getOffer($id){
        $id = (int) $id;
        return  $this->offer->active()->when(!auth()->check(),function ($query){
            $query->where('expired_at','>',Carbon::now())->where('start_at','<=',Carbon::now());
        })->when(auth()->check(), function ($query){
            $query->isFavourite(auth()->id())->subscribed(auth()->id());
        })->findOrFail($id);
    }

    public function getByCategory($category_id,$id=null){
        return $this->offer->active()->where('expired_at','>',Carbon::now())->where('start_at','<=',Carbon::now())->whereIn('id',$category_id)->where('quantity','>=',1)->orderBy('order','desc')->get();
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
}
