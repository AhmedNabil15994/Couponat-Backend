<?php

namespace Modules\Area\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Modules\Core\Traits\Dashboard\CrudModel;
use Modules\Core\Traits\HasTranslations;

class State extends Model
{
    use CrudModel,SoftDeletes, HasTranslations;

    protected $fillable = ['status', 'city_id', 'title', 'slug'];
    public $translatable = ['title', 'slug'];

    public function city()
    {
        return $this->belongsTo(City::class);
    }

    public function areas()
    {
        return $this->hasMany(Area::class);
    }
}
