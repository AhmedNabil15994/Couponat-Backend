<?php

namespace Modules\Order\Entities;

use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;
use IlluminateAgnostic\Collection\Support\Carbon;
use Modules\Core\Traits\ScopesTrait;
use Modules\Transaction\Entities\Transaction;

class Order extends Model
{
    use SoftDeletes ;
    use ScopesTrait;

    protected $fillable = [
        'total',
        'unread',
        'subtotal',
        'discount',
        'user_id',
        'address_id',
        'is_holding',
        'order_status_id',
        'period',
    ];

    public function user()
    {
        return $this->belongsTo(\Modules\User\Entities\User::class)->withTrashed();
    }

    public function orderStatus()
    {
        return $this->belongsTo(OrderStatus::class);
    }

    public function orderItems()
    {
        return $this->hasMany(OrderItem::class);
    }


    public function coupon()
    {
        return $this->hasOne(OrderCoupon::class, 'order_id');
    }

    public function scopeUserAccess($query, $userId, $pivot_table = 'order_courses')
    {
        return $query->where(function ($q) use($userId, $pivot_table){
            $q->where(['orders.user_id' => $userId])->whereHas('orderStatus', fn($q) => $q->successPayment());


            if(in_array($pivot_table,['order_items'])) {
                $q->orWhereHas('orderItems', function ($whereQuery) use($userId){
                    $whereQuery->where('seller_id',$userId);
                });
            }
        });
    }

    public function transactions()
    {
        return $this->morphOne(Transaction::class, 'transaction');
    }
}
