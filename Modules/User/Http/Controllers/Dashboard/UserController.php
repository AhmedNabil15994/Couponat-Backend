<?php

namespace Modules\User\Http\Controllers\Dashboard;

use Illuminate\Routing\Controller;
use Modules\Core\Traits\Dashboard\CrudDashboardController;

class UserController extends Controller
{
    use CrudDashboardController;

    public function show($id) {
        $model = $this->repository->findById($id);
        $userData['orders'] = $this->repository->orders($id);
        $userData['transactions'] = $this->repository->transactions($id);
        return view('user::dashboard.users.show',compact('model','userData'));
    }

    public function verify($id) {
        $model = $this->repository->findById($id);
        $model->update(['is_verified' => true]);
        return redirect()->back();
    }
}
