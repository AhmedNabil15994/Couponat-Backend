<?php

namespace Modules\Category\Repositories\Vendor;

use Modules\Category\Entities\Category;
use DB;
use Modules\Core\Repositories\Dashboard\CrudRepository;

class CategoryRepository extends CrudRepository
{

    public function __construct()
    {
        parent::__construct(Category::class);
    }

    public function mainCategories($order = 'order', $sort = 'desc')
    {
        $categories = $this->model->where('type',1)->mainCategories()->orderBy($order, $sort)->get();
        return $categories;
    }
}
