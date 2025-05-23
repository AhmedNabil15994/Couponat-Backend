<?php

namespace Modules\User\Repositories\Dashboard;

use Modules\Transaction\Entities\Transaction;
use Modules\User\Entities\User;
use Illuminate\Support\Facades\DB;
use Modules\Core\Traits\RepositorySetterAndGetter;
use Modules\Core\Repositories\Dashboard\CrudRepository;

class UserRepository extends CrudRepository
{
    public function __construct()
    {
        parent::__construct(User::class);
        $this->transaction = new Transaction();
    }


    public function userCreatedStatistics()
    {
        $data['userDate'] = $this->model
            ->doesnthave('roles')
            ->select(DB::raw("DATE_FORMAT(created_at,'%Y-%m') as date"))
            ->groupBy('date')
            ->pluck('date');

        $userCounter = $this->model
            ->doesnthave('roles')
            ->select(DB::raw('count(id) as countDate'))
            ->groupBy(DB::raw("DATE_FORMAT(created_at, '%Y-%m')"))
            ->get();

        $data['countDate'] = json_encode(array_pluck($userCounter, 'countDate'));

        return $data;
    }

    public function countUsers($order = 'id', $sort = 'desc')
    {
        $users = $this->model->doesnthave('roles')->count();

        return $users;
    }


    /*
    * Find Object By ID
    */
    public function findById($id)
    {
        $user = $this->model->withDeleted()->find($id);

        return $user;
    }

    /*
    * Find Object By ID
    */
    public function findByEmail($email)
    {
        $user = $this->model->where('email', $email)->first();

        return $user;
    }

    public function getSellers(){
        return $this->model->getSellers();
    }

    public function getCustomers() {
        return $this->model->doesntHave('roles.permissions')->whereHas('orders.orderStatus', fn($q) => $q->successPayment())->orderBy('id','DESC')->get();
    }
    /*
    * Generate Datatable
    */
    public function QueryTable($request)
    {
        $query = $this->model->doesntHave('roles.permissions')->where('id', '!=', auth()->id())->where(function ($query) use ($request) {
            $query->where('id', 'like', '%' . $request->input('search.value') . '%');
            $query->orWhere('name', 'like', '%' . $request->input('search.value') . '%');
            $query->orWhere('email', 'like', '%' . $request->input('search.value') . '%');
            $query->orWhere('mobile', 'like', '%' . $request->input('search.value') . '%');
        });

        $query = $this->filterDataTable($query, $request);

        return $query;
    }

    public function orders($id) {
        $user = $this->model->find($id);
        if(!$user){
            abort(404);
        }
        return $user->orders;
    }

    public function transactions($id) {
        $user = $this->model->find($id);
        if(!$user){
            abort(404);
        }
        return $this->transaction->whereHas('order',function ($q) use ($id) {
            $q->where('user_id',$id);
        })->orderBy('id','DESC')->get();
    }
}
