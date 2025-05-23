<?php

namespace Modules\Order\Entities;

use Carbon\Carbon;
use Modules\Offer\Entities\Offer;
use Modules\User\Entities\User;
use Illuminate\Database\Eloquent\Model;
use Psy\Util\Str;

class OrderItem extends Model
{
    protected $fillable = [
        'price',
        'off',
        'qty',
        'total',
        'offer_id',
        'order_id',
        'user_id',
        'start_date',
        'expired_date',
        'is_redeemed',
        'redeemed_at',
        'period',
        'seller_id',
        'code',
    ];

    public function offer()
    {
        return $this->belongsTo(Offer::class)->withTrashed();
    }

    public function user()
    {
        return $this->belongsTo(User::class)->withTrashed();
    }

    public function order()
    {
        return $this->belongsTo(Order::class);
    }

    public function seller()
    {
        return $this->belongsTo(User::class,'seller_id','id');
    }

    public function scopeNotExpired($q)
    {
        $q->whereNull('expired_date')
            ->orWhere('expired_date', '>=', Carbon::now()->toDateTimeString());
    }

    public function scopeSellerScope($q,$id)
    {
        return $q->where('seller_id',$id)->orWhere('seller_id',auth()->user()->seller_id);
    }


    function scopeSuccessPay($q)
    {
        $q->whereHas(
            'order',
            fn ($q) => $q->whereHas(
                'orderStatus',
                fn ($q) => $q->successPayment()
            )
        );
    }

    public static function boot()
    {
        parent::boot();

        static::creating(function ($orderItem) {
            $orderItem->code = strtoupper(\Str::random(10));
            $filename_path = $orderItem->code.".png";
            $decoded = base64_decode(base64_encode(\QrCode::format('png')->size(100)->generate(route('vendor.home').'?code='.$orderItem->code )));
            file_put_contents(public_path('/uploads/qr/').$filename_path,$decoded);
        });
    }
}
