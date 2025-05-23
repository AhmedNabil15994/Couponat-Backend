<?php

namespace Modules\Order\Http\Controllers\Api;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\DB;
use Modules\Apps\Http\Controllers\Api\ApiController;
use Modules\Cart\Traits\CartTrait;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Modules\Offer\Transformers\Api\ShowOfferResource;
use Modules\Order\Transformers\Api\OrderResource;
use Modules\Transaction\Services\TapPaymentService;
use Modules\Transaction\Traits\PaymentTrait;
use Modules\Transaction\Services\PaymentService;
use Modules\Authentication\Foundation\Authentication;
use Modules\Transaction\Services\MyFatoorahPaymentService;
use Modules\Order\Http\Requests\Frontend\CreateOrderRequest;
use Modules\Order\Repositories\Api\OrderRepository as Order;
use Modules\Offer\Repositories\Api\OfferRepository as Offer;
use Modules\Authentication\Repositories\Api\AuthenticationRepository;

class OrderController extends ApiController
{
    use Authentication;
    use CartTrait;
    use PaymentTrait;


    public function __construct(public Order $order, public PaymentService $payment, public Offer $offer, public AuthenticationRepository $auth)
    {
    }

    public function index() {
        $orders = auth('sanctum')->user()->orders()
            ->whereHas('orderItems' , function ($query) {
                $query->where('expired_date','>=',date('Y-m-d'));
            })
            ->whereHas('orderStatus', fn($q) => $q->successPayment())
            ->orderBy('id','DESC')->paginate(15);
        return $this->responsePaginationWithData(OrderResource::collection($orders));
    }

    public function show($id) {
        $orders = auth('sanctum')->user()->orders()
            ->where('id',$id)->with(['orderItems'=>function($withQuery){
                if(request()->offer_id){
                    $withQuery->where('offer_id',request()->offer_id)->groupBy('offer_id');
                }
            }])
            ->whereHas('orderStatus', fn($q) => $q->successPayment())->orderBy('id','DESC')->first();
        if(!$orders){
            return  $this->error(__('order::api.invalid_order'));
        }
        if(request()->offer_id){
            return $this->response(new ShowOfferResource($orders));
        }else{
            return $this->response(new OrderResource($orders));
        }
    }

    public function create(Request $request)
    {
        $cart = $this->getCartContent();
        if (count($cart) > 0) {
            return $this->addOrder($request);
        }

        return $this->error(__('Your cart is impty'));
    }

    public function addOrder($data)
    {
        DB::beginTransaction();


        $user = $data->user();

        $data['user_id'] = $user->id;

        $order =  $this->order->create($data);
        $payment = $this->getPaymentGateway('tap');
        DB::commit();

        $redirect = $payment->send($order, 'orders',$data->user_token,'api');

        if (isset($redirect['status'])) {

            if ($redirect['status'] == true) {
                return $this->response([
                    'payment_ur' => $redirect['url'],
                    'order_id'  => $order->id,
                ]);
            } else {
                return $this->error(__('Online Payment not valid now'));
            }
        }

        return $this->error('field');
    }

    public function success(Request $request)
    {
        $order = $this->order->findById($request['OrderID']);
        if (!$order) {
            return false;
        }
        $this->payment->setTransactions($request,$order);

        $this->order->update($request['OrderID'], true);
        $this->sendNotifications($request['OrderID']);

        $this->clearCart();
        return $this->response(new OrderResource($order), __('Payment completed successfully'));
    }

    public function cancel(Request $request,$id)
    {
        $id = (int) $id;
        $order = $this->order->findById($id);
        if(!$order){
            return $this->error(__('Invalid Order, please check again'));
        }
        $order->update(['order_status_id' => 3]);
        return $this->response([], __('Order Cancelled Successfully !!'));
    }

    public function sendNotifications($order_id)
    {
        $order = $this->order->findById($order_id);
        if (!$order) {
            return false;
        }
        $data = ['order'=>$order];

        try {
            Mail::send('order::dashboard.orders.invoice',$data,function ($message) use ($order){
                $message->to($order->user->email)->subject('Couponat Order: #'.$order->id);
            });

            Mail::send('order::dashboard.orders.invoice',$data,function ($message) use ($order){
                $message->to(setting('contact_us','email'))->subject('Couponat Order: #'.$order->id);
            });
        }catch (\Exception $e){}
    }

    public function failed(Request $request)
    {
        $order = $this->order->findById($request['OrderID']);
        if (!$order) {
            return false;
        }
        $order->update(['order_status_id'=>2]);
        return $this->error(__('Failed Payment , please try again'));
    }
    public function successUpayment(Request $request)
    {
        if ($request->Result == 'CAPTURED') {
            return $this->success($request);
        }
        return $this->failed($request);
    }

    public function failedUpayment(Request $request)
    {
        return $this->failed($request);
    }

    public function successTap(Request $request)
    {
        $data = (new TapPaymentService())->getTransactionDetails($request);

        $request = PaymentTrait::buildTapRequestData($data, $request);

        if ($request->Result == 'CAPTURED') {
            return $this->success($request);
        }
        return $this->failed($request);

    }
}
