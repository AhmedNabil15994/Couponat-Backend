<?php

namespace Modules\User\Http\Controllers\Vendor;

use Illuminate\Routing\Controller;
use Modules\Core\Traits\Dashboard\CrudDashboardController;
use Modules\User\Entities\User;

class UserController extends Controller
{
    use CrudDashboardController;
}
