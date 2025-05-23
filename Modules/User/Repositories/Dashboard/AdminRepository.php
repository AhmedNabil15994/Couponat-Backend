<?php

namespace Modules\User\Repositories\Dashboard;

use Modules\Core\Repositories\Dashboard\CrudRepository;
use Modules\User\Entities\User;

class AdminRepository extends CrudRepository
{
    public function __construct()
    {
        parent::__construct(User::class);
    }

    public function QueryTable($request)
    {
        $query = $this->model
        ->whereHas('roles.permissions', function ($query) {
            $query->where('name', 'dashboard_access');
        })
        ->where(function ($query) use ($request) {
            $query->where($this->model->getKeyName(), 'like', '%' . $request->input('search.value') . '%');
            $this->appendSearch($query, $request);
            foreach ($this->getModelTranslatable() as $key) {
                $query->orWhere($key . '->' . locale(), 'like', '%' . $request->input('search.value') . '%');
            }
        });
        $query = $this->filterDataTable($query, $request);
        return $query;
    }

    public function modelCreated($model, $request, $is_created = true): void
    {
        if ($request['roles'] != null) {
            $this->saveRoles($model, $request);
        }
    }

    public function modelUpdated($model, $request): void
    {
        if ($request['roles'] != null) {
            $this->saveRoles($model, $request);
        }
    }
    public function saveRoles($user, $request)
    {
        $user->syncRoles($request['roles']);
        return true;
    }

    public function filterDataTable($query, $request)
    {
        $query=parent::filterDataTable($query, $request);
        if (isset($request['req']['roles']) && $request['req']['roles'] != '') {
            $query->whereHas('roles', function ($query) use ($request) {
                $query->where('id', $request['req']['roles']);
            });
        }

        return $query;
    }
}
