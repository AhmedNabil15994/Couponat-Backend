<?php

namespace Modules\Area\Http\Controllers\Vendor;


use Illuminate\Routing\Controller;
use Modules\Core\Traits\Dashboard\CrudDashboardController;

class StateController extends Controller
{
    use CrudDashboardController;

    public function getByCityId($city_id){
        return response()->json($this->model->active()->where('city_id',$city_id)->get());
    }
}
