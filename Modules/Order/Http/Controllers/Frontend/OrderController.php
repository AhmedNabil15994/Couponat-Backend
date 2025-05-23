<?php

namespace Modules\Order\Http\Controllers\Frontend;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\DB;
use Modules\Cart\Traits\CartTrait;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Modules\Coupon\Http\Controllers\Frontend\CouponController;
use Modules\Offer\Entities\Offer;
use Modules\Order\Entities\PaymentStatus;
use Modules\Order\Mail\BoughtCourse;
use Modules\Order\Transformers\WebService\OrderResource;
use Modules\Transaction\Services\TapPaymentService;
use Modules\Transaction\Traits\PaymentTrait;
use Modules\Transaction\Services\PaymentService;
use Modules\Authentication\Foundation\Authentication;
use Modules\Transaction\Services\MyFatoorahPaymentService;
use Modules\Order\Http\Requests\Frontend\CreateOrderRequest;
use Modules\Order\Repositories\Frontend\OrderRepository as Order;
use Modules\Authentication\Repositories\Frontend\AuthenticationRepository;

class OrderController extends Controller
{
    use Authentication;
    use CartTrait;
    use PaymentTrait;


    public function __construct(public Order $order, public PaymentService $payment, public Offer $offer, public AuthenticationRepository $auth)
    {
    }

//    public function index(Request $request)
//    {
//
//        $offers = $this->getCartContent();
//
//        if (count($offers) > 0) {
//            return view('order::frontend.checkout', compact('offers'));
//        }
//
//        return redirect()->route('frontend.cart.index');
//    }
//
    public function createView()
    {
        $cart = $this->getCartContent();
        return view('order::frontend.show', compact('cart'));
    }

    public function create(CreateOrderRequest $request)
    {
        $cart = $this->getCartContent();
        if (auth()->guest()) {
            session()->put('to_checkout',1);
            session()->put('old_token',$this->userToken());
            $data= $request->all();
            unset($data['_token']);
            session()->put('old_data',$data);
            return redirect()->route('frontend.auth.login', ['from' => 'checkout']);
        }
        /* if (!auth()->check()) {
            $this->auth->register($request->validated());
            $this->loginAfterRegister($request);
        } */
        if (count($cart) > 0) {
            return $this->addOrder($request);
        }

        return redirect()->route('frontend.cart.index');
    }

//    public function event(CreateOrderRequest $request)
//    {
//        $event = $this->offer->findEventBySlug($request['slug']);
//
//        $order =  $this->order->createOrderEvent($event);
//
//        if ($request['payment'] != 'cash') {
//            $url = $this->payment->send($order, 'orders', $request['payment']);
//            return redirect($url);
//        }
//
//        return view('order::frontend.show_event', compact('order'));
//    }

    public function addOrder($data)
    {
        DB::beginTransaction();

        if (!auth()->check()) {
            return redirect()->route('frontend.register');
        } else {
            $user = auth()->user();
        }

        $data['user_id'] = $user->id;


        $order =  $this->order->create($data);

        $payment = $this->getPaymentGateway($data['payment_type']);
        session()->forget('old_data');
        DB::commit();
        $redirect = $payment->send($order, 'orders');
        session()->forget('discount');

        if (isset($redirect['status'])) {
            if ($redirect['status'] == true) {
                $order->transactions()->create([
                    'method' => $data['payment_type'],
                    'result' => null,
                ]);
                return redirect()->away($redirect['url']);
            } else {
                return back()->withInput()->withErrors(['payment' => 'Online Payment not valid now']);
            }
        }

        return 'failed';
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
        session()->forget('order_id');
        return redirect()->route('frontend.order.completed');
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
        return redirect()->route('frontend.cart.checkout')->with([
            'status'    => 'danger',
            'msg'      => __('Failed Payment , please try again'),
        ]);
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

    public function successUpayment(Request $request)
    {
        if ($request->Result == 'CAPTURED') {
            return $this->success($request);
        }
        return $this->failed($request);
    }

    public function myFatoorahCallBack(Request $request)
    {
        $data = (new MyFatoorahPaymentService())->GetPaymentStatus($request->paymentId , 'paymentId');

        $request = PaymentTrait::buildMyFatoorahRequestData($data, $request);

        if ($request->Result == 'CAPTURED') {
            return $this->success($request);
        }
        return $this->failed($request);
    }

    public function orderCompleted(Request $request)
    {
        return view('order::frontend.success-order-payment');
    }
}
