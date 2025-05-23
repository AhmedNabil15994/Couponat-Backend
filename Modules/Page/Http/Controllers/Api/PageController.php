<?php

namespace Modules\Page\Http\Controllers\Api;

use Illuminate\Http\Request;
use Modules\Page\Transformers\Api\PageResource;
use Modules\Page\Repositories\Api\PageRepository as Page;
use Modules\Apps\Http\Controllers\Api\ApiController;

class PageController extends ApiController
{

    function __construct(Page $page)
    {
        $this->page = $page;
    }

    public function pages()
    {
        $pages =  $this->page->getAllActivePaginate();

        return PageResource::collection($pages);
    }

    public function page($id)
    {
        $page = $this->page->findById($id);

        if(!$page)
          return $this->response([]);

        return $this->response(new PageResource($page));
    }
}
