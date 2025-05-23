<?php

namespace Modules\Category\Repositories\Api;

use Illuminate\Http\Request;
use Modules\Category\Entities\Category;

class CategoryRepository
{
    private $category;

    function __construct(Category $category)
    {
        $this->category = $category;
    }

    public function getAllCategories($request, $order = 'order', $sort = 'asc')
    {
        return $this->category->active()->where('type',1)->mainCategories()->orderBy($order, $sort)->get();
    }

    public function findById($id)
    {
        return $this->category->active()->with(['children'])->find($id);
    }
}
