<?php

namespace Modules\User\Entities;

use Modules\Offer\Entities\Offer;
use Modules\User\Entities\User;
use Illuminate\Database\Eloquent\Model;
use Modules\Core\Traits\ClearsResponseCache;
use Modules\Core\Traits\HasCompositePrimaryKey;

class Favorite extends Model
{
    use HasCompositePrimaryKey;
  //  use  ClearsResponseCache;

    protected $fillable = ["user_id", "offer_id"];

    protected $primaryKey = ["offer_id", "user_id"];


    public function offer()
    {
        return $this->belongsTo(Offer::class, "offer_id");
    }

    public function user()
    {
        return $this->belongsTo(User::class, "user_id");
    }

}


