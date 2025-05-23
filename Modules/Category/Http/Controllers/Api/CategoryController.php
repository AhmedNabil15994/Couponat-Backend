<?php

namespace Modules\Category\Http\Controllers\Api;

use Illuminate\Http\Request;
use Modules\Category\Transformers\Api\{CategoryResource,ShowCategoryResource};
use Modules\Category\Repositories\Api\CategoryRepository as Category;
use Modules\Apps\Http\Controllers\Api\ApiController;
use Modules\Slider\Repositories\Api\SliderRepository as Slider;
use Modules\Slider\Transformers\Api\SliderResource;

class CategoryController extends ApiController
{
    private $category;

    function __construct(Category $category)
    {
        if (request()->hasHeader('authorization'))
            $this->middleware('auth:sanctum');

        $this->category = $category;
    }

    public function categories(Request $request)
    {
        $categories =  CategoryResource::collection($this->category->getAllCategories($request));
        return $categories;
    }

    public function show(Request $request, $id)
    {
        return $this->response(new CategoryResource($this->category->findById($id)));
    }
}
