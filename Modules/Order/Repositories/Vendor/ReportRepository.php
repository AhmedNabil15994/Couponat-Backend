<?php

namespace Modules\Order\Repositories\Vendor;

use Modules\Core\Traits\RepositorySetterAndGetter;
use Modules\Offer\Entities\Offer;
use Modules\Order\Entities\Order;
use Modules\Order\Entities\OrderItem;
use Modules\User\Entities\User;

class ReportRepository
{
    use RepositorySetterAndGetter;

    public function __construct(Order $order,OrderItem $orderItem, User $user , Offer $offer)
    {
        $this->order = $order;
        $this->orderItem = $orderItem;
        $this->user = $user;
        $this->offer = $offer;
    }

    public function QueryVendors($request)
    {
        $query = $this->user;
        $seller_id = auth()->user()->seller_id != null ? auth()->user()->seller_id : auth()->id();

        $query = $query->where('id',$seller_id)->Sellers()->SellersActiveOrders()
            ->withSum(['seller_order_items'=>function ($query) use ($request) {
                $query->SuccessPay();
                if (isset($request['req']['from']) && $request['req']['from'] != '') {
                    $query->whereDate('created_at', '>=', $request['req']['from']);
                }
                if (isset($request['req']['to']) && $request['req']['to'] != '') {
                    $query->whereDate('created_at', '<=', $request['req']['to']);
                }
            }],'total')
            ->withCount(['seller_order_items'=> function ($q) use ($request) {
                $q->SuccessPay();
                if (isset($request['req']['from']) && $request['req']['from'] != '') {
                    $q->whereDate('created_at', '>=', $request['req']['from']);
                }
                if (isset($request['req']['to']) && $request['req']['to'] != '') {
                    $q->whereDate('created_at', '<=', $request['req']['to']);
                }
                $q->select(\DB::raw('count(distinct(order_id)) as orders_count'));
            }]);

        return $query;
    }

    public function QueryCustomers($request)
    {
        $query = $this->user;
        $seller_id = auth()->user()->seller_id != null ? auth()->user()->seller_id : auth()->id();

        if(isset($request['req']['user_id']) && !empty($request['req']['user_id'])){
            $query = $query->where('id',$request['req']['user_id']);
        }

        $query = $query->doesnthave('roles')
            ->with('orderItems')
            ->whereHas('orders.orderStatus', fn($q) => $q->successPayment())
            ->withSum(['orderItems'=>function ($query) use ($request,$seller_id) {
                $query->sellerScope($seller_id);
                if (isset($request['req']['from']) && $request['req']['from'] != '') {
                    $query->whereDate('created_at', '>=', $request['req']['from']);
                }
                if (isset($request['req']['to']) && $request['req']['to'] != '') {
                    $query->whereDate('created_at', '<=', $request['req']['to']);
                }
            }],'total')
            ->withCount(['orders'=> function ($q) use ($request,$seller_id) {
                if (isset($request['req']['from']) && $request['req']['from'] != '') {
                    $q->whereDate('created_at', '>=', $request['req']['from']);
                }
                if (isset($request['req']['to']) && $request['req']['to'] != '') {
                    $q->whereDate('created_at', '<=', $request['req']['to']);
                }
                $q->whereHas('orderItems',function ($query) use ($seller_id){
                    $query->sellerScope($seller_id);
                });
                $q->select(\DB::raw('count(id) as orders_count'));
            }]);
        return $query;
    }

    public function QueryOffers($request)
    {
        $seller_id = auth()->user()->seller_id != null ? auth()->user()->seller_id : auth()->id();

        $query = $this->offer->user($seller_id);

        if(isset($request['req']['offer_id']) && !empty($request['req']['offer_id'])){
            $query = $query->where('id',$request['req']['offer_id']);
        }

        $query = $query->withSum(['orderItems'=>function ($q) use ($request,$seller_id) {
                $q->sellerScope($seller_id)->whereHas('order.orderStatus',fn($q) => $q->successPayment());
                if (isset($request['req']['from']) && $request['req']['from'] != '') {
                    $q->whereDate('created_at', '>=', $request['req']['from']);
                }
                if (isset($request['req']['to']) && $request['req']['to'] != '') {
                    $q->whereDate('created_at', '<=', $request['req']['to']);
                }
            }],'total')
            ->withCount(['orderItems'=> function ($q) use ($request,$seller_id) {
                $q->sellerScope($seller_id)->whereHas('order.orderStatus',fn($q) => $q->successPayment());
                if (isset($request['req']['from']) && $request['req']['from'] != '') {
                    $q->whereDate('created_at', '>=', $request['req']['from']);
                }
                if (isset($request['req']['to']) && $request['req']['to'] != '') {
                    $q->whereDate('created_at', '<=', $request['req']['to']);
                }
                $q->select(\DB::raw('count(order_id) as orders_count'));
            }])->withSum(['orderItems'=>function ($q) use ($request,$seller_id) {
                $q->sellerScope($seller_id)->whereHas('order.orderStatus',fn($q) => $q->successPayment());
                if (isset($request['req']['from']) && $request['req']['from'] != '') {
                    $q->whereDate('created_at', '>=', $request['req']['from']);
                }
                if (isset($request['req']['to']) && $request['req']['to'] != '') {
                    $q->whereDate('created_at', '<=', $request['req']['to']);
                }
            }],'is_redeemed');

        return $query;
    }
}

