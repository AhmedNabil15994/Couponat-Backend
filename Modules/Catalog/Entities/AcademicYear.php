<?php

namespace Modules\Catalog\Entities;

use Illuminate\Database\Eloquent\Model;
use Modules\Core\Traits\HasTranslations;
use Modules\Core\Traits\Dashboard\CrudModel;
use Illuminate\Database\Eloquent\SoftDeletes;

class AcademicYear extends Model
{
    use CrudModel, SoftDeletes,HasTranslations;
    
    protected $fillable = ['status', 'title'];
    public $translatable = ['title'];

    public function users()
    {
        return $this->hasMany(User::class, 'options->locale_id');
    }
}
