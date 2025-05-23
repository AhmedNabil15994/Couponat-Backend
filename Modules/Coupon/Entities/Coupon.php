<?php

namespace Modules\Coupon\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Modules\Category\Entities\Category;
use Modules\Core\Traits\ScopesTrait;
use Modules\Order\Entities\Order;
use Modules\Order\Entities\OrderCoupon;
use Modules\Package\Entities\Package;
use Modules\User\Entities\User;
use Modules\Vendor\Entities\Vendor;

use Spatie\Translatable\HasTranslations;
class Coupon extends Model
{
    use HasTranslations, SoftDeletes, ScopesTrait;

    protected $with = [];
    protected $guarded = ['id'];

    public $translatable = ['title'];

    public function orders()
    {
        return $this->hasMany(OrderCoupon::class);
    }

}
