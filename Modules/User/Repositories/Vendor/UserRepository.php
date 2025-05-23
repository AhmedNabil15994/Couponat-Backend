<?php

namespace Modules\User\Repositories\Vendor;

use Modules\User\Entities\User;
use Illuminate\Support\Facades\DB;
use Modules\Core\Traits\RepositorySetterAndGetter;
use Modules\Core\Repositories\Dashboard\CrudRepository;

class UserRepository extends CrudRepository
{
    public function __construct()
    {
        parent::__construct(User::class);
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
    /*
    * Generate Datatable
    */
    public function QueryTable($request)
    {
        $query = $this->model->doesntHave('roles.permissions')->whereHas('orderItems',function ($q){
                if(auth()->user()->can('seller_access')){
                    $q->where('seller_id',auth()->id());
                }
            })->where(function ($query) use ($request) {
                $query->where('id', 'like', '%' . $request->input('search.value') . '%');
                $query->orWhere('name', 'like', '%' . $request->input('search.value') . '%');
                $query->orWhere('email', 'like', '%' . $request->input('search.value') . '%');
                $query->orWhere('mobile', 'like', '%' . $request->input('search.value') . '%');
            })->when(auth()->user()->can('seller_access'),function ($q){
                $q->orWhere('id',auth()->id());
            });

        $query = $this->filterDataTable($query, $request);

        return $query;
    }
}
