<?php

namespace Modules\Area\Http\Controllers\Vendor;


use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Route;
use Modules\Area\Entities\Area;
use Modules\Core\Traits\Dashboard\CrudDashboardController;

class AreaController extends Controller
{
    use CrudDashboardController {
        CrudDashboardController::__construct as private __tConstruct;
    }

    public function __construct(Area $area)
    {

        $this->__tConstruct();
        $this->model = $area;
    }
}
