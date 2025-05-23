<?php

namespace Modules\Offer\Entities;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Modules\Area\Entities\City;
use Modules\Area\Entities\State;
use Modules\Category\Entities\Category;
use Modules\Core\Traits\ScopesTrait;
use Modules\Order\Entities\Order;
use Modules\Order\Entities\OrderCoupon;
use Modules\Order\Entities\OrderItem;
use Modules\User\Entities\User;

use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\Translatable\HasTranslations;
class Offer extends Model  implements HasMedia
{
    use HasTranslations, SoftDeletes, ScopesTrait,InteractsWithMedia;

    protected $with = [];
    protected $guarded = ['id'];
    public $translatable = ['title','description','details','discount_desc'];
    protected $appends = ['main_image','images','images_arr','discount'];

    public function getMainImageAttribute(){
        return $this->getFirstMediaUrl('main_image') ?? '';
    }

    public function getImagesAttribute(){
//        $mediaArr = [];
//        foreach($this->getMedia('images') as $oneImage){
//            $mediaArr[] = $oneImage->getUrl();
//        }
//        return $mediaArr;
        return $this->getFirstMediaUrl('images') ?? '';
    }

    public function getImagesArrAttribute(){
        $mediaArr = [];
        foreach($this->getMedia('images') as $oneImage){
            $mediaArr[] = $oneImage->getUrl();
        }
        return $mediaArr;
    }

    public function getDiscountAttribute()
    {
        return [
            'desc' => [
                'en'    => $this->getTranslations('discount_desc')['en'],
                'ar'    => $this->getTranslations('discount_desc')['ar'],
            ],
        ];
    }

    public function seller(){
       return $this->hasOne(User::class,'id','seller_id');
    }

    public function category(){
        return $this->hasOne(\Modules\Category\Entities\Category::class,'id','category_id');
    }

    public function state(){
        return $this->hasOne(State::class,'id','state_id');
    }

    public function city(){
        return $this->hasOne(City::class,'id','city_id');
    }

    public function userFavorites()
    {
        return $this->belongsToMany(User::class, "favorites", "offer_id", "user_id")
            ->withTimestamps();
    }

    public function scopeIsFavourite($query, $user_id)
    {
        return $query->withCount([
            "userFavorites as is_favorite" => function ($query) use ($user_id) {
                $query->select(\DB::raw("count(favorites.offer_id) > 0 "))
                    ->whereRaw("users.id = ?", $user_id);
            }
        ]);
    }

    public function orderItems()
    {
        return $this->hasMany(OrderItem::class);
    }
    public function scopeSubscribed($q, $user_id)
    {
        return $q
            ->withCount(
                [
                    'orderItems as is_subscribed' => fn ($q) => $q->whereUserId($user_id)->notExpired()->successPay()
                ]
            );
    }

    public function scopeIsSubscribed($q, $user_id)
    {
        return $q->where('user_valid_until','>',date('Y-m-d'))->expired()->whereHas('orderItems',function ($q) use ($user_id){
            $q->whereUserId($user_id)->notExpired()->successPay();
        });
    }

    public function scopeUser($q,$id) {
        return $q->where('seller_id',$id);
    }


    public function orders()
    {
        return $this->belongsToMany(Order::class,'order_items')->withPivot('expired_date');
    }

    public function scopeExpired($q) {
        return $q->where('expired_at','<',date('Y-m-d'));
    }

    public static function checkSubscription($id){
        return self::when(auth()->check(), fn ($q) => $q->subscribed(auth()->id()))
            ->withCount('orderItems')
            ->whereHas(
                'orderItems',
                fn ($q) => $q
                    ->whereUserId(auth()->id())
                    ->notExpired()
                    ->successPay()
            )->orderBy('id', 'desc')->find($id);
    }

    public function offersCategories() {
        return $this->hasMany(OfferCategory::class,'offer_id','id');
    }
    public function categories()
    {
        return $this->belongsToMany(Category::class, "offers_categories", "offer_id", "category_id")
            ->withTimestamps();
    }

    public static function getRelated($offer) {
        return  self::whereHas('offersCategories',function ($q) use ($offer){
            $q->whereIn('category_id',$offer->categories->where('id','!=',1)->pluck('id')->toArray());
        })->where('id','!=',$offer->id)->active()->where('quantity','>=',1)->where('expired_at','>',date('Y-m-d'))->take(5)->get();
//        $ids = [];
//        foreach ($offer->categories as $category){
//            $data = $category->pivot->where('offer_id','!=',$offer->id)->distinct('offer_id')->pluck('offer_id')->toArray();
//            $ids = array_unique(array_merge($ids,$data));
//        }
//        return self::active()->whereIn('id',$ids)->where('quantity','>=',1)->where('expired_at','>',date('Y-m-d'))->take(5)->get();
    }
}
