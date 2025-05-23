<?php

namespace Modules\Category\Entities;

use Carbon\Carbon;
use Modules\Course\Entities\Note;
use Modules\Offer\Entities\Offer;
use Modules\Package\Entities\PackagePrice;
use Spatie\MediaLibrary\HasMedia;
use Modules\Course\Entities\Course;
use Illuminate\Database\Eloquent\Model;
use Modules\Core\Traits\HasTranslations;
use Spatie\MediaLibrary\InteractsWithMedia;
use Modules\Core\Traits\Dashboard\CrudModel;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Modules\Package\Entities\Package;
use Staudenmeir\EloquentJsonRelations\HasJsonRelationships;

class Category extends Model implements HasMedia
{
    use CrudModel, SoftDeletes, InteractsWithMedia;
    use HasJsonRelationships, HasTranslations {
        HasJsonRelationships::getAttributeValue as getAttributeValueJson;
        HasTranslations::getAttributeValue as getAttributeValueTranslations;
    }

    public function getAttributeValue($key)
    {
        if (!$this->isTranslatableAttribute($key)) {
            return $this->getAttributeValueJson($key);
        }
        return $this->getAttributeValueTranslations($key);
    }
    protected $fillable = ['status', 'type', 'category_id', 'title','color','order','start_at','expired_at','banner_size'];
    public $translatable = ['title'];

    public function parent()
    {
        return $this->belongsTo(Category::class, 'category_id');
    }

    public function users()
    {
        return $this->hasMany(User::class, 'options->locale_id');
    }

    public function children()
    {
        return $this->hasMany(Category::class, 'category_id');
    }

    public function getParentsAttribute()
    {
        $parents = collect([]);
        $parent = $this->parent;
        while (!is_null($parent)) {
            $parents->push($parent);
            $parent = $parent->parent;
        }
        return $parents;
    }

    public function getBanner($id) {
        return $this->where('id',$id)->where('expired_at','>=',date('Y-m-d'))->first() ?? '';
    }

    public function scopeMainCategories($query)
    {
        return $query->where('category_id', '=', null);
    }

    public function offers()
    {
        return $this->belongsToMany(Offer::class, "offers_categories", "category_id", "offer_id")
            ->withTimestamps();
    }

    public function validOffers() {
        return $this->offers()->active()->where('expired_at','>',Carbon::now())
            ->where('start_at','<=',Carbon::now());
    }
}
