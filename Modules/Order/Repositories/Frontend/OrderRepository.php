<?php

namespace Modules\Order\Repositories\Frontend;

use Auth;
use CartTrait;
use Carbon\Carbon;
use Modules\Coupon\Http\Controllers\Frontend\CouponController;
use Modules\Course\Entities\Note;
use Modules\Offer\Entities\Offer;
use Modules\Order\Entities\Address;
use Modules\Order\Entities\Order;
use Illuminate\Support\Facades\DB;
use Modules\Course\Entities\Course;
use Modules\Course\Notifications\NewCourseEnrollmentNotification;
use Modules\Order\Entities\OrderItem;
use Modules\Order\Entities\OrderStatus;
use Modules\Order\Traits\OrderCalculationTrait;
use Modules\Package\Entities\PackagePrice;

class OrderRepository
{
    use OrderCalculationTrait;

    public function __construct(Order $order, OrderStatus $status, Offer $offer,Address $address)
    {
        $this->offer = $offer;
        $this->order = $order;
        $this->status = $status;
        $this->address = $address;
    }

    public function getAllByUser()
    {
        return $this->order->where('user_id', auth()->id())->get();
    }

    public function findById($id)
    {
        return $this->order->where('id', $id)->first();
    }


    public function createOrderEvent($event, $status = true)
    {
        DB::beginTransaction();

        try {
            $status = $this->statusOfOrder(false);

            $order = $this->order->create([
                'is_holding' => true,
                'discount' => 0.000,
                'subtotal' => $event['price'],
                'total' => $event['price'],
                'user_id' => auth()->id(),
                'order_status_id' => $status->id,
            ]);


            $this->orderEvent($order, $event);

            DB::commit();
            return $order;
        } catch (\Exception $e) {
            DB::rollback();
            throw $e;
        }
    }

    public function create($request, $status = 3)
    {

        try {
            DB::beginTransaction();

            $data = $this->calculateTheOrder($request);
            $status = $this->statusOfOrder(3);

            if (!$data) {
                return false;
            }

            if(session()->has('discount')){
                $coupon_data = (new CouponController)->getCouponData(session()->get('discount'),$data['total']);
            }else{
                $coupon_data = null;
            }

            $orderData = [
                'is_holding' => true,
                'discount' => $coupon_data && $coupon_data[0] ? $coupon_data[1]['coupon_value'] : 0.000,
                'total' => $coupon_data && $coupon_data[0] ? $coupon_data[1]['total'] : $data['total'],
                'subtotal' => $data['subtotal'],
                'user_id' => $request->user_id,
                'order_status_id' => $status->id,
            ];

            if(session()->has('order_id')){
                $order = $this->order->find(session()->get('order_id'));
                $order->update($orderData);
            }else{
                $order = $this->order->create($orderData);
            }

            if($request['name'] && $request['name'] != ''){
                $order->user->update(['name'=> $request['name']]);
            }

            if($coupon_data){
                $order->coupon()->create([
                    'coupon_id' => $coupon_data[2]['id'],
                    'code' => $coupon_data[2]['code'],
                    'discount_type' => $coupon_data[2]['discount_type'],
                    'discount_percentage' => $coupon_data[2]['discount_percentage'],
                    'discount_value' => $coupon_data[2]['discount_value'],
                ]);
            }else{
                $order->coupon()->delete();
            }

            $this->orderItems($order, $data);

            session()->put('order_id',$order->id);
            DB::commit();
            return $order;
        } catch (\Exception $e) {
            DB::rollback();
            throw $e;
        }
    }


    public function orderItems($order, $data)
    {
        foreach ($data['order_offers'] as $key => $orderOffer) {
            $offer = $orderOffer['offer'];
            for ($i=0;$i<$orderOffer['quantity'];$i++){
                $price = $orderOffer['total'];
                if($order->coupon){
                    $price = calcDiscount($orderOffer['total'],$order->coupon)['price_after_discount'];
                }
                $order->orderItems()->create([
                    'offer_id'    => $offer->id,
                    'qty'        => 1,
                    'total'        => $price,
                    'seller_id'   => $offer->seller_id,
                    'user_id'      => auth()->user()->id,
                    'start_date' => $offer->user_valid_from,
                    'expired_date' => $offer->user_valid_until,
                ]);
            }
        }
    }


    public function update($id, $boolean)
    {
        $order = $this->findById($id);

        $status = $this->statusOfOrder($boolean);

        $order->update([
            'is_hold' => false,
            'order_status_id' => $status['id']
        ]);

        if($boolean){
            foreach($order->orderItems as $item ){
                $item->offer->update(['quantity' => $item->offer->quantity - $item->qty]);
            }
        }

        $this->updateOfferPeriod($order);

        return $order;
    }

    private function updateOfferPeriod($order): void
    {
        foreach ($order->orderItems()->get() as $orderItem) {
            $offer = $orderItem->offer;

            if ($offer->expired_at) :
                $orderItem->update([
                    'period' => round((strtotime($offer->user_valid_until) - strtotime($offer->start_at))/3600/24),
                    'start_date' => $offer->user_valid_from,
                    'expired_date' => $offer->user_valid_until,
                ]);
            endif;

            $this->notify($orderItem);
        }
    }

    public function statusOfOrder($type)
    {
        if ($type == 1) {
            $status = $this->status->successPayment()->first();
        }else if($type == 2){
            $status = $this->status->failedOrderStatus()->first();
        }else if ($type == 3) {
            $status = $this->status->pendingOrderStatus()->first();
        }
        return $status;
    }




    private function notify(OrderItem $orderItem): void
    {
        // $orderCourse->user->notify(new NewCourseEnrollmentNotification($orderItem->offer));
    }
}
