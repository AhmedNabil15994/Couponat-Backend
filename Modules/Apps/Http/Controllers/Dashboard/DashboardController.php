<?php

namespace Modules\Apps\Http\Controllers\Dashboard;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Modules\Authorization\Entities\Role;
use Modules\Course\Entities\Course;
use Modules\Course\Entities\Note;
use Modules\Exam\Entities\Exam;
use Modules\Offer\Entities\Offer;
use Modules\Order\Entities\Order;
use Modules\Order\Entities\OrderItem;
use Modules\Order\Repositories\Dashboard\OrderRepository;
use Modules\Package\Entities\Package;
use Modules\Trainer\Entities\Trainer;
use Modules\User\Entities\User;
use DB;
class DashboardController extends Controller
{
    public function __construct(OrderRepository $order) {
        $this->order = $order;
    }
    public function index(Request $request)
    {
        $item = null;
        $qr = null;
        if($request->code){
            $item = OrderItem::with('offer','order')->where('code','LIKE','%'.$request->code.'%')->first();
            if($item){
                $qr = asset('uploads/qr/'.$item->code.'.png');
                $item->qr = $qr;
            }else{
                return redirect()->to(route('dashboard.home'))->withErrors(["Sorry, this offer is not listed under your company offers","عذراً، هذا العرض هو غير مدرج تحت عروض شركتكم"]);
            }
        }
        return view('apps::dashboard.index',compact('item'));
    }

    public function statistics(Request $request) {
        $data= [
            'offers' => Offer::active(),
            'activeOffers' => Offer::where('expired_at','>',date('Y-m-d')),
            'expiredOffers' =>  Offer::where('expired_at','<',date('Y-m-d')),
            'redeemedOffers'   => OrderItem::where('is_redeemed',1),
            'unredeemedOffers'  => OrderItem::whereHas('order',function ($q){
                $q->where('order_status_id',1);
            })->where('is_redeemed',0),
        ];

        foreach ($data as $key => $item) {
            $data[$key] = $this->filter($request,$item)->count();
        }

        $data['totalOrdersCount'] = $this->filterOrder($request,Order::where('id','!=',null))->count();
        $data['pendingOrdersCount'] = $this->filterOrder($request,Order::where('order_status_id',3))->count();
        $data['activeOrdersCount'] = $this->filterOrder($request,Order::where('order_status_id',1))->count();
        $data['totalOrdersProfit'] = $this->filterOrder($request,Order::where('order_status_id',1))->sum('total');

        $data['totalRedeemed'] = $this->filter($request,OrderItem::whereHas('order',function ($q){
            $q->where('order_status_id',1);
        })->where('is_redeemed',1))->sum('total');

        $data['totalUnredeemed'] = $this->filter($request,OrderItem::whereHas('order',function ($q){
            $q->where('order_status_id',1);
        })->where('is_redeemed',0))->sum('total');
        $data['sellers']    = User::whereHas('roles.permissions', function ($q) {
            $q->where('name', 'seller_access');
        })->whereNull('seller_id')->get();

        $chartsData = $this->getChartsData($request);
        $data = array_merge($data,$chartsData);

        return view('apps::dashboard.statistics',compact('data'));
    }

    private function filter($request, $model)
    {
        return $model->where(function ($query) use ($request) {
            // Search Users by Created Dates
            if ($request->from)
                $query->whereDate('created_at', '>=', $request->from);

            if ($request->to)
                $query->whereDate('created_at', '<=', $request->to);

            if ($request->seller_id)
                $query->where('seller_id', $request->seller_id);

        });
    }
    private function filterOrder($request, $model)
    {
        return $model->where(function ($query) use ($request) {
            // Search Users by Created Dates
            if ($request->from)
                $query->whereDate('created_at', '>=', $request->from);

            if ($request->to)
                $query->whereDate('created_at', '<=', $request->to);
        })->whereHas('orderItems',function ($q) use ($request){
            if ($request->seller_id)
                $q->where('seller_id', $request->seller_id);
        });
    }

    private function getChartsData($request) {
        $data['userCreated']["userDate"] = User::doesnthave('roles.permissions')
            ->where(function ($q){
                if((request()->has('from') && !empty(request()->get('from'))) &&
                    (request()->has('to') && !empty(request()->get('to')))){
                   $q->whereDate('created_at', '>=', request()->from)->whereDate('created_at', '<=', request()->to);
                }
                if(request()->has('seller_id') && !empty(request()->get('seller_id'))){
                    $q->whereHas('orderItems',function ($q){
                        $q->where('seller_id', request()->seller_id);
                    });
                }
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
                if(request()->has('seller_id') && !empty(request()->get('seller_id'))){
                    $q->whereHas('orderItems',function ($q){
                        $q->where('seller_id', request()->seller_id);
                    });
                }
            })
            ->select(DB::raw("count(id) as countDate"))
            ->groupBy(DB::raw("DATE_FORMAT(created_at, '%Y-%m')"))
            ->orderBy('created_at','asc')
            ->get();


        $data['userCreated']["countDate"] = json_encode(array_column($userCounter->toArray(), 'countDate'));

        $data['monthlyOrders'] = $this->order->monthlyOrders();

        return $data;
    }
}
