<?php

namespace Modules\Order\Http\Controllers\Dashboard;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Mail;
use Modules\Core\Traits\DataTable;
use Modules\Order\Http\Requests\Dashboard\OrderRequest;
use Modules\Order\Transformers\Dashboard\OrderResource;
use Modules\Order\Repositories\Dashboard\OrderRepository as Order;
use Modules\Order\Repositories\Dashboard\OrderStatusRepository as Status;
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
        return view('order::dashboard.orders.index');
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
        return view('order::dashboard.orders.show', compact('order', 'statuses'));
    }

    public function update(Request $request, $id)
    {
        try {
            $update = $this->order->update($request, $id);

            if ($update) {
                return Response()->json([true , __('apps::dashboard.messages.updated')]);
            }

            return Response()->json([false  , __('apps::dashboard.messages.failed')]);
        } catch (\PDOException $e) {
            return Response()->json([false, $e->errorInfo[2]]);
        }
    }

    public function destroy($id)
    {
        try {
            $delete = $this->order->delete($id);

            if ($delete) {
                return Response()->json([true , __('apps::dashboard.messages.deleted')]);
            }

            return Response()->json([false  , __('apps::dashboard.messages.failed')]);
        } catch (\PDOException $e) {
            return Response()->json([false, $e->errorInfo[2]]);
        }
    }

    public function deletes(Request $request)
    {
        try {
            $deleteSelected = $this->order->deleteSelected($request);

            if ($deleteSelected) {
                return Response()->json([true , __('apps::dashboard.messages.deleted')]);
            }

            return Response()->json([false  , __('apps::dashboard.messages.failed')]);
        } catch (\PDOException $e) {
            return Response()->json([false, $e->errorInfo[2]]);
        }
    }

    public function pending_orders(){
        $statuses = $this->status->getAll();
        return view('order::dashboard.pending_orders.index', compact( 'statuses'));
    }

    public function failed_orders(){
        $statuses = $this->status->getAll();
        return view('order::dashboard.failed_orders.index', compact( 'statuses'));
    }

    public function active_orders(){
        $statuses = $this->status->getAll();
        return view('order::dashboard.active_orders.index', compact( 'statuses'));
    }


    public function invoice($id) {
        $order = $this->order->findById($id);
        if (!$order) {
            return false;
        }
        $data = ['order'=>$order];
        Mail::send('order::dashboard.orders.invoice',$data,function ($message) use ($order){
            $message->to($order->user->email)->subject('Couponat Order: #'.$order->id);
        });
        return redirect()->back()->with([
            'msg' => __('apps::dashboard.sent_success'),
        ]);
//        return view('order::dashboard.orders.invoice', compact( 'order'));
    }
}
