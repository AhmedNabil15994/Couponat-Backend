<?php

namespace Modules\Page\Http\Controllers\Dashboard;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Modules\Core\Traits\Dashboard\CrudDashboardController;
use Modules\Core\Traits\DataTable;
use Modules\Page\Http\Requests\Dashboard\PageRequest;
use Modules\Page\Transformers\Dashboard\PageResource;
use Modules\Page\Repositories\Dashboard\PageRepository as Page;

class PageController extends Controller
{
    use CrudDashboardController;
}
