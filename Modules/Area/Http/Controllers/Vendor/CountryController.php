<?php

namespace Modules\Area\Http\Controllers\Vendor;


use Illuminate\Routing\Controller;
use Modules\Area\Entities\Country;
use Modules\Area\Repositories\Dashboard\CountryRepository;
use Modules\Core\Traits\Dashboard\CrudDashboardController;

class CountryController extends Controller
{
    use CrudDashboardController ;

}
