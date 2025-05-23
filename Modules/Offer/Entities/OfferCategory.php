<?php

namespace Modules\Offer\Entities;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Modules\Category\Entities\Category;

class OfferCategory extends Model
{

    protected $guarded = ['id'];
    protected $table = 'offers_categories';


    public function category(){
       return $this->hasOne(Category::class,'id','category_id');
    }

    public function offer(){
        return $this->hasOne(Offer::class,'id','offer_id');
    }
}
