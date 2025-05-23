<?php

namespace Modules\Area\Http\Controllers\Dashboard;


use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Route;
use Modules\Core\Traits\Dashboard\CrudDashboardController;

class AreaController extends Controller
{
    use CrudDashboardController;

    public function __construct()
    {
        // abort(404);
    }
}
