<?php

namespace Modules\Page\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Modules\Core\Traits\Dashboard\CrudModel;
use Modules\Core\Traits\HasTranslations;

class Page extends Model
{
    use CrudModel,SoftDeletes, HasTranslations;

    protected $fillable = ['status', 'type', 'page_id','description', 'title', 'slug', 'seo_description', 'seo_keywords'];
    public $translatable = ['description', 'title', 'slug', 'seo_description', 'seo_keywords'];
}
