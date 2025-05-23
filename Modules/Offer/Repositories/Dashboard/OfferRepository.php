<?php

namespace Modules\Offer\Repositories\Dashboard;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Modules\Core\Repositories\Dashboard\CrudRepository;
use Modules\Offer\Entities\Offer;

class OfferRepository extends CrudRepository
{

    public function __construct()
    {
        parent::__construct(Offer::class);
        $this->statusAttribute = ['status','is_published'];
        $this->fileAttribute       = ['main_image' => 'main_image','images'=>'images'];
    }

    public function QueryTable($request)
    {
        $query = $this->model->where(function ($q) use ($request){
            if (isset($request['search']['value']) && !empty($request['search']['value'])) {
                $q->where(DB::raw('lower(title)'),'LIKE','%'.strtolower($request['search']['value']).'%')
                    ->orWhere(DB::raw('lower(discount_desc)'),'LIKE','%'.strtolower($request['search']['value']).'%');
            }
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
        if (isset($request['req']['category_id']) && $request['req']['category_id'] != '') {
            $query->where('category_id',$request['req']['category_id']);
        }
        if (isset($request['req']['seller_id']) && $request['req']['seller_id'] != '') {
            $query->where('seller_id',$request['req']['seller_id']);
        }
        return $query;
    }

    public function update(Request $request, $id)
    {
        DB::beginTransaction();

        $model = $this->findById($id);
        $request->trash_restore ? $this->restoreSoftDelete($model) : null;

        try {
            if ($key = array_search('null', $request->all())) {
                $request->merge([$key => null]);
            }

            $status = $this->handleStatusInRequest($request);
            $data = $request->all();
            if (count($status) > 0) {
                $data = array_merge($data, $status);
            }
            // call the prepareData fuction
            $data = $this->prepareData($data, $request, false);

            $model->update($data);

            // call the callback  fuction
            $this->modelUpdated($model, $request);

            $this->handleFileAttributeInRequest($model, $request, true,'images');

            DB::commit();
            $this->commitedAction($model, $request, "update");
            return true;
        } catch (\Exception $e) {
            DB::rollback();
            throw $e;
        }
    }

    public function modelCreated($model, $request, $is_created = true): void
    {
        if($request->category_id && !empty($request->category_id)){
            $categories = explode(',',$request->category_id);
            $model->categories()->sync($categories);
        }
    }

    public function modelUpdated($model, $request): void
    {
        if($request->category_id && !empty($request->category_id)){
            $categories = explode(',',$request->category_id);
            $model->categories()->sync($categories);
        }
    }

}
