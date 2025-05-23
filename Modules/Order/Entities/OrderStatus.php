<?php

namespace Modules\Order\Entities;

use Illuminate\Database\Eloquent\Model;
use Modules\Core\Traits\HasTranslations;
use Modules\Core\Traits\ScopesTrait;

class OrderStatus extends Model
{
    use ScopesTrait;

    protected $fillable= ['title','color_label', 'success_status', 'failed_status', 'final_status'];

}
