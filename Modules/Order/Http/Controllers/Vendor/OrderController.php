<?php

namespace Modules\Order\Http\Controllers\Vendor;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\Core\Traits\DataTable;
use Modules\Order\Http\Requests\Vendor\OrderRequest;
use Modules\Order\Transformers\Vendor\OrderResource;
use Modules\Order\Repositories\Vendor\OrderRepository as Order;
use Modules\Order\Repositories\Vendor\OrderStatusRepository as Status;
use Modules\Order\Notifications\Api\ResponseOrderNotification;
use Notification;

class OrderController extends Controller
{
    private $order;

    public function __construct(Order $order, Status $status)
    {
        $this->order = $order;
        $this->status = $status;
    }

    public function index()
    {
        return view('order::vendor.orders.index');
    }

    public function datatable(Request $request)
    {
        $datatable = DataTable::drawTable($request, $this->order->QueryTable($request));

        $datatable['data'] = OrderResource::collection($datatable['data']);

        return Response()->json($datatable);
    }

    public function show($id)
    {
        // $this->order->updateUnread($id);
        $order = $this->order->findById($id);
        //
        // Notification::route('mail', $order->email)
        // ->notify((new ResponseOrderNotification($order))->locale(locale()));
        $statuses = $this->status->getAll();
        return view('order::vendor.orders.show', compact('order', 'statuses'));
    }

    public function update(Request $request, $id)
    {
        try {
            $update = $this->order->update($request, $id);

            if ($update) {
                return Response()->json([true , __('apps::vendor.messages.updated')]);
            }

            return Response()->json([false  , __('apps::vendor.messages.failed')]);
        } catch (\PDOException $e) {
            return Response()->json([false, $e->errorInfo[2]]);
        }
    }

    public function destroy($id)
    {
        try {
            $delete = $this->order->delete($id);

            if ($delete) {
                return Response()->json([true , __('apps::vendor.messages.deleted')]);
            }

            return Response()->json([false  , __('apps::vendor.messages.failed')]);
        } catch (\PDOException $e) {
            return Response()->json([false, $e->errorInfo[2]]);
        }
    }

    public function deletes(Request $request)
    {
        try {
            $deleteSelected = $this->order->deleteSelected($request);

            if ($deleteSelected) {
                return Response()->json([true , __('apps::vendor.messages.deleted')]);
            }

            return Response()->json([false  , __('apps::vendor.messages.failed')]);
        } catch (\PDOException $e) {
            return Response()->json([false, $e->errorInfo[2]]);
        }
    }

    public function pending_orders(){
        $statuses = $this->status->getAll();
        return view('order::vendor.pending_orders.index', compact( 'statuses'));
    }

    public function failed_orders(){
        $statuses = $this->status->getAll();
        return view('order::vendor.failed_orders.index', compact( 'statuses'));
    }

    public function active_orders(){
        $statuses = $this->status->getAll();
        return view('order::vendor.active_orders.index', compact( 'statuses'));
    }
}
