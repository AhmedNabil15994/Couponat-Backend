<?php

namespace Modules\User\Http\Controllers\Dashboard;

use Illuminate\Routing\Controller;
use Modules\Core\Traits\Dashboard\CrudDashboardController;
use Modules\User\Entities\User;

class EmployeeController extends Controller
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
