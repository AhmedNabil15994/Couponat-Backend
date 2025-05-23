<?php

namespace Modules\DeviceToken\Http\Controllers\Dashboard;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Modules\Core\Traits\Dashboard\CrudDashboardController;
use Modules\DeviceToken\Entities\PersonalAccessToken;

class DeviceTokenController extends Controller
{
    use CrudDashboardController{
        CrudDashboardController::__construct as CrudeConstruct;
    }

    public function __construct()
    {
        $this->CrudeConstruct();
        $this->setViewPath('devicetoken::dashboard.device-tokens');
        $this->setModel(PersonalAccessToken::class);
    }
}
