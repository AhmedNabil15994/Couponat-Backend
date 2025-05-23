<?php

namespace Modules\User\Http\Controllers\Dashboard;

use Modules\User\Entities\User;
use Illuminate\Routing\Controller;
use Modules\Core\Traits\Dashboard\CrudDashboardController;

class AdminController extends Controller
{
    use CrudDashboardController {
        CrudDashboardController::__construct as private __crudConstruct;
    }

    public function __construct()
    {
        $this->__crudConstruct();
        $this->model=new User();
    }
}
