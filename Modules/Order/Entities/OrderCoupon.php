<?php


namespace Modules\Order\Entities;

use Illuminate\Database\Eloquent\Model;
use Modules\Coupon\Entities\Coupon;
use Modules\Order\Entities\Order;

class OrderCoupon extends Model
{
    protected $guarded = ['id'];

    public function order()
    {
        return $this->belongsTo(Order::class);
    }

    public function coupon()
    {
        return $this->belongsTo(Coupon::class);
    }

}
