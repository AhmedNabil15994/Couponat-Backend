<?php

namespace Modules\Category\ViewComposers\Frontend;

use Modules\Category\Repositories\Frontend\CategoryRepository as Category;
use Illuminate\View\View;
use Cache;

class CategoryComposer
{
    public $categories = [];

    public function __construct(Category $category)
    {
        $this->categories =  $category->mainCategories('order','asc');
    }

    /**
     * Bind data to the view.
     *
     * @param  View  $view
     * @return void
     */
    public function compose(View $view)
    {
        $view->with('mainCategories' , $this->categories);
    }
}
