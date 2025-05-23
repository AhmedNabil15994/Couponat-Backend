<?php

namespace Modules\Apps\Http\Controllers\Vendor;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\DB;
use Modules\Authorization\Entities\Role;
use Modules\Course\Entities\Course;
use Modules\Course\Entities\Note;
use Modules\Exam\Entities\Exam;
use Modules\Offer\Entities\Offer;
use Modules\Order\Entities\Order;
use Modules\Order\Entities\OrderItem;
use Modules\Order\Repositories\Vendor\OrderRepository;
use Modules\Package\Entities\Package;
use Modules\Trainer\Entities\Trainer;
use Modules\User\Entities\User;

class DashboardController extends Controller
{
    public function __construct(OrderRepository $order) {
        $this->order = $order;
    }
    public function index(Request $request)
    {
        $seller_id = auth()->user()->seller_id != null ? auth()->user()->seller_id : auth()->id();

        $item = null;
        $qr = null;
        if($request->code){
            $item = OrderItem::with('offer','order')->sellerScope($seller_id)->where('code','LIKE','%'.$request->code.'%')->first();
            if($item){
                $qr = asset('uploads/qr/'.$item->code.'.png');
                $item->qr = $qr;
            }else{
                return redirect()->to(route('vendor.home'))->withErrors(["Sorry, this offer is not listed under your company offers","عذراً، هذا العرض هو غير مدرج تحت عروض شركتكم"]);
            }
        }
        return view('apps::vendor.index',compact('item'));
    }
    public function statistics(Request $request)
    {
        $seller_id = auth()->user()->seller_id != null ? auth()->user()->seller_id : auth()->id();

        $data= [
            'offers' => Offer::user($seller_id)->active(),
            'activeOffers' => Offer::user($seller_id)->where('status',true),
            'expiredOffers' =>  Offer::user($seller_id)->where('expired_at','<',date('Y-m-d')),

            'redeemedOffers'   => OrderItem::sellerScope($seller_id)->where('is_redeemed',1),
            'unredeemedOffers'  => OrderItem::sellerScope($seller_id)->whereHas('order',function ($q){
                $q->where('order_status_id',1);
            })->where('is_redeemed',0),

            'totalOrdersCount' => Order::whereHas('orderItems',function ($q) use ($seller_id){
                $q->sellerScope($seller_id);
            })->where('id','!=',null),
            'pendingOrdersCount' => Order::whereHas('orderItems',function ($q) use ($seller_id){
                $q->sellerScope($seller_id);
            })->where('order_status_id',3),
            'activeOrdersCount' => Order::whereHas('orderItems',function ($q) use ($seller_id){
                $q->sellerScope($seller_id);
            })->where('order_status_id',1),
        ];

        foreach ($data as $key => $item) {
            $data[$key] = $this->filter($request,$item)->count();
        }

        $data['totalOrdersProfit'] = $this->filter($request,OrderItem::sellerScope($seller_id)->whereHas('order',function ($q){
            $q->where('order_status_id',1);
        }))->sum('total');
        $data['totalRedeemed'] = $this->filter($request,OrderItem::sellerScope($seller_id)->whereHas('order',function ($q){
            $q->where('order_status_id',1);
        })->where('is_redeemed',1))->sum('total');

        $data['totalUnredeemed'] = $this->filter($request,OrderItem::sellerScope($seller_id)->whereHas('order',function ($q){
            $q->where('order_status_id',1);
        })->where('is_redeemed',0))->sum('total');

        $chartsData = $this->getChartsData($request);
        $data = array_merge($data,$chartsData);

        return view('apps::vendor.statistics',compact('data'));
    }
    private function filter($request, $model)
    {

        return $model->where(function ($query) use ($request) {

            // Search Users by Created Dates
            if ($request->from)
                $query->whereDate('created_at', '>=', $request->from);

            if ($request->to)
                $query->whereDate('created_at', '<=', $request->to);

        });
    }

    private function getChartsData($request) {
        $seller_id = auth()->user()->seller_id != null ? auth()->user()->seller_id : auth()->id();

        $data['userCreated']["userDate"] = User::doesnthave('roles.permissions')
            ->where(function ($q){
                if((request()->has('from') && !empty(request()->get('from'))) &&
                    (request()->has('to') && !empty(request()->get('to')))){
                    $q->whereDate('created_at', '>=', request()->from)->whereDate('created_at', '<=', request()->to);
                }
            })
            ->whereHas('orderItems',function ($q) use ($seller_id){
                $q->where('seller_id',$seller_id)->whereHas('order',function ($q2){
                    $q2->whereHas('orderStatus', function ($q3) {
                        $q3->successPayment();
                    });
                });
            })
            ->select(DB::raw("DATE_FORMAT(created_at,'%Y-%m') as date"))
            ->groupBy('date')
            ->orderBy('created_at','asc')
            ->pluck('date');

        $userCounter = User::doesnthave('roles.permissions')
            ->where(function ($q){
                if((request()->has('from') && !empty(request()->get('from'))) &&
                    (request()->has('to') && !empty(request()->get('to')))){
                    $q->whereDate('created_at', '>=', request()->from)->whereDate('created_at', '<=', request()->to);
                }
            })
            ->whereHas('orderItems',function ($q) use ($seller_id){
                $q->where('seller_id',$seller_id)->whereHas('order',function ($q2){
                    $q2->whereHas('orderStatus', function ($q3) {
                        $q3->successPayment();
                    });
                });
            })
            ->select(DB::raw("count(id) as countDate"),'id')
            ->groupBy(DB::raw("DATE_FORMAT(created_at, '%Y-%m')"))
            ->orderBy('created_at','asc')
            ->get();

        $data['userCreated']["countDate"] = json_encode(array_column($userCounter->toArray(), 'countDate'));

        $data['monthlyOrders'] = $this->order->monthlyOrders();
        return $data;
    }
}
