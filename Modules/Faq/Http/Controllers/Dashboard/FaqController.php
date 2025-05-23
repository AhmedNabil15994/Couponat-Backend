<?php

namespace Modules\Faq\Http\Controllers\Dashboard;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Modules\Core\Traits\DataTable;
use Illuminate\Routing\Controller;
use Modules\Core\Traits\Dashboard\CrudDashboardController;

class FaqController extends Controller
{

    use CrudDashboardController;

}
