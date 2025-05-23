<?php

namespace Modules\Area\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Modules\Core\Traits\Dashboard\CrudModel;
use Modules\Core\Traits\HasTranslations;

class City extends Model
{
    use CrudModel,SoftDeletes, HasTranslations;

    protected $fillable = ['status', 'country_id','title', 'slug'];
    public $translatable = ['title', 'slug'];

    public function country()
    {
        return $this->belongsTo(Country::class);
    }

    public function states()
    {
        return $this->hasMany(State::class);
    }
}
