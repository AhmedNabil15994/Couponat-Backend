<?php

namespace Modules\Coupon\Http\Controllers\Vendor;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Modules\Core\Traits\DataTable;
use Modules\Coupon\Http\Requests\Dashboard\CouponRequest;
use Modules\Coupon\Repositories\CouponRepository;
use Modules\Coupon\Transformers\Dashboard\CouponResource;
use Modules\Sliders\Transformers\Dashboard\SliderResource;


class CouponController extends Controller
{
    protected $coupon;

    function __construct(CouponRepository $coupon)
    {
        $this->coupon = $coupon;
    }

    /**
     * Display a listing of the resource.
     * @return Response
     */
    public function index()
    {
        return view('coupon::vendor.index');
    }

    public function datatable(Request $request)
    {
        $datatable = DataTable::drawTable($request, $this->coupon->QueryTable($request));

        $datatable['data'] = CouponResource::collection($datatable['data']);

        return Response()->json($datatable);
    }

    /**
     * Show the form for creating a new resource.
     * @return Response
     */
    public function create()
    {
        return view('coupon::vendor.create');
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Response
     */
    public function store(CouponRequest $request)
    {
        try {
            $create = $this->coupon->create($request);

            if ($create) {
                return Response()->json([true,__('apps::vendor.messages.created')]);
            }

            return Response()->json([false, __('apps::vendor.messages.failed')]);
        } catch (\PDOException $e) {
            return Response()->json([false, $e->errorInfo[2]]);
        }
    }

    /**
     * Show the specified resource.
     * @param int $id
     * @return Response
     */
    public function show($id)
    {
        return view('coupon::vendor.show');
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Response
     */
    public function edit($id)
    {
        $coupon = $this->coupon->findById($id);
        return view('coupon::vendor.edit', compact('coupon'));
    }

    public function clone($id)
    {
        $coupon = $this->coupon->findById($id);
        return view('coupon::vendor.clone', compact('coupon'));
    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param int $id
     * @return Response
     */
    public function update(CouponRequest $request, $id)
    {
        try {
            $update = $this->coupon->update($request, $id);

            if ($update) {
                return Response()->json([true,__('apps::vendor.messages.updated')]);
            }

            return Response()->json([false, __('apps::vendor.messages.failed')]);
        } catch (\PDOException $e) {
            return Response()->json([false, $e->errorInfo[2]]);
        }
    }

    /**
     * Remove the specified resource from storage.
     * @param int $id
     * @return Response
     */
    public function destroy($id)
    {
        try {
            $delete = $this->coupon->delete($id);

            if ($delete) {
                return Response()->json([true, __('apps::vendor.messages.deleted')]);
            }

            return Response()->json([false, __('apps::vendor.messages.failed')]);
        } catch (\PDOException $e) {
            return Response()->json([false, $e->errorInfo[2]]);
        }
    }

    public function deletes(Request $request)
    {
        try {
            $deleteSelected = $this->coupon->deleteSelected($request);

            if ($deleteSelected) {
                return Response()->json([true, __('apps::vendor.messages.deleted')]);
            }

            return Response()->json([false,  __('apps::vendor.messages.failed')]);
        } catch (\PDOException $e) {
            return Response()->json([false, $e->errorInfo[2]]);
        }
    }
}
