<?php

namespace Modules\Order\Repositories\Dashboard;

use Hash;
use Illuminate\Support\Facades\DB;
use Modules\Order\Entities\OrderStatus;
use Modules\Core\Traits\RepositorySetterAndGetter;

class OrderStatusRepository
{
    use RepositorySetterAndGetter;

    public function __construct(OrderStatus $orderStatus)
    {
        $this->orderStatus = $orderStatus;
    }

    public function getAll($order = 'id', $sort = 'desc')
    {
        $orderStatuses = $this->orderStatus->orderBy($order, $sort)->get();
        return $orderStatuses;
    }

    public function getAllFinalStatus($order = 'id', $sort = 'desc')
    {
        $orderStatuses = $this->orderStatus->finalStatus()->orderBy($order, $sort)->get();
        return $orderStatuses;
    }

    public function findById($id)
    {
        $orderStatus = $this->orderStatus->find($id);
        return $orderStatus;
    }

    public function create($request)
    {
        DB::beginTransaction();

        try {
            $orderStatus = $this->orderStatus->create([
                'success_status' => $request->success_status ? 1 : false,
                'failed_status' => $request->failed_status ? 1 : false,
                'color_label' => $request->color_label,
                'final_status' => false,
                'title' => $request->title,
            ]);

            DB::commit();
            return true;
        } catch (\Exception $e) {
            DB::rollback();
            throw $e;
        }
    }

    public function update($request, $id)
    {
        DB::beginTransaction();

        $orderStatus = $this->findById($id);
        $request->restore ? $this->restoreSoftDelete($orderStatus) : null;

        try {
            $orderStatus->update([
                'success_status' => $request->success_status ? 1 : null,
                'failed_status' => $request->failed_status ? 1 : null,
                'color_label' => $request->color_label,
                'title' => $request->title,
            ]);

            DB::commit();
            return true;
        } catch (\Exception $e) {
            DB::rollback();
            throw $e;
        }
    }

    public function restoreSoftDelete($model)
    {
        $model->restore();
    }

    public function delete($id)
    {
        DB::beginTransaction();

        try {
            $orderStatus = $this->findById($id);

            $orderStatus->delete();

            DB::commit();
            return true;
        } catch (\Exception $e) {
            DB::rollback();
            throw $e;
        }
    }

    public function deleteSelected($request)
    {
        DB::beginTransaction();

        try {
            foreach ($request['ids'] as $id) {
                $model = $this->delete($id);
            }

            DB::commit();
            return true;
        } catch (\Exception $e) {
            DB::rollback();
            throw $e;
        }
    }

    public function QueryTable($request)
    {
        $query = $this->orderStatus->where(function ($query) use ($request) {
            $query->where('id', 'like', '%' . $request->input('search.value') . '%');
        })->orWhere(function ($query) use ($request) {
            $query->orWhere('title'.'->' . locale(), 'like', '%' . $request->input('search.value') . '%');
        });

        $query = $this->filterDataTable($query, $request);

        return $query;
    }

    public function filterDataTable($query, $request)
    {
        if (isset($request['req']['from']) && $request['req']['from'] != '') {
            $query->whereDate('created_at', '>=', $request['req']['from']);
        }

        if (isset($request['req']['to']) && $request['req']['to'] != '') {
            $query->whereDate('created_at', '<=', $request['req']['to']);
        }

        if (isset($request['req']['deleted']) && $request['req']['deleted'] == 'only') {
            $query->onlyDeleted();
        }

        if (isset($request['req']['deleted']) && $request['req']['deleted'] == 'with') {
            $query->withDeleted();
        }

        if (isset($request['req']['status']) && $request['req']['status'] == '1') {
            $query->active();
        }

        if (isset($request['req']['status']) && $request['req']['status'] == '0') {
            $query->unactive();
        }

        return $query;
    }
}
