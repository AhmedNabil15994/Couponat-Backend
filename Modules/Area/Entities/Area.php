<?php

namespace Modules\Area\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Modules\Core\Traits\HasTranslations;
use Modules\Core\Traits\Dashboard\CrudModel;

class Area extends Model
{
    use CrudModel,SoftDeletes, HasTranslations;

    protected $fillable = ['status', 'state_id','title', 'slug'];
    public $translatable = ['title', 'slug'];

    public function state()
    {
        return $this->belongsTo(State::class);
    }
}
