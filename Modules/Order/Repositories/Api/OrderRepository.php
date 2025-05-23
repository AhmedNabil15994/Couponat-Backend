<?php

namespace Modules\Order\Repositories\Api;

use Modules\Order\Entities\OrderItem;
use Modules\Order\Traits\OrderCalculationTrait;
use Modules\Order\Entities\OrderStatus;
use Modules\Order\Entities\Order;
use Modules\User\Entities\User;
use Carbon\Carbon;
use Auth;
use DB;

class OrderRepository
{
    use OrderCalculationTrait;

    public function __construct(Order $order, OrderStatus $status, User $user)
    {
        $this->user      = $user;
        $this->order     = $order;
        $this->status    = $status;
    }

    public function getAllByUser()
    {
        return $this->order->where('user_id', auth()->id())->get();
    }

    public function findById($id)
    {
        return $this->order->where('id', $id)->first();
    }

    public function rateOrder($request)
    {
        $order = $this->findById($request['order_id']);

        $order->rate()->updateOrCreate(
            [
            'order_id'  => $request['order_id']
        ],
            [
            'order_rate'     => $request['order_rate'],
            'service_rate'   => $request['service_rate'],
            'vendor_rate'    => $request['vendor_rate'],
            'delivery_rate'  => $request['delivery_rate'],
        ]
        );

        return true;
    }

    public function create($request, $status = true)
    {
        DB::beginTransaction();

        try {
            $data = $this->calculateTheOrder($request);

            $status = $this->statusOfOrder(3);

            $user =  $this->user->find($request['user_token']);
            if(auth('sanctum')->check()){
                $user = auth('sanctum')->user();
            }

            $order = $this->order->create([
                'is_holding'        => false,
                'subtotal'          => $data['subtotal'],
                'discount'          => $data['discount'],
                'total'             => $data['total'],
                'user_id'           => $user ? $user['id'] : 1,
                'order_status_id'   => $status->id,
            ]);

            $this->orderProducts($order, $data);

            DB::commit();
            return $order;
        } catch (\Exception $e) {
            DB::rollback();
            throw $e;
        }
    }

    public function orderProducts($order, $data)
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

    public function orderAddress($order, $data)
    {
        $order->address()->create([
            'floor'         => $data['address']['floor'],
            'building'      => $data['address']['building'],
            'door'          => $data['address']['door'],
            'street'        => $data['address']['street'],
            'address'       => $data['address']['address'],
            'area_id'       => $data['address']['area_id'],
            'username'      => $data['address']['username'],
            'mobile'        => $data['address']['mobile'],
            'email'         => $data['address']['email'],
        ]);
    }

    public function updateOrder($request)
    {
        $order = $this->findById($request['OrderID']);

        $status = ($request['Result'] == 'CAPTURED') ? $this->statusOfOrder(true) : $this->statusOfOrder(false);

        $order->update([
          'order_status_id' => $status['id'],
          'is_holding'      => false
        ]);

        $order->transactions()->updateOrCreate(
            [
            'transaction_id'  => $request['OrderID']
          ],
            [
            'auth'          => $request['Auth'],
            'tran_id'       => $request['TranID'],
            'result'        => $request['Result'],
            'post_date'     => $request['PostDate'],
            'ref'           => $request['Ref'],
            'track_id'      => $request['TrackID'],
            'payment_id'    => $request['PaymentID'],
        ]
        );

        return ($request['Result'] == 'CAPTURED') ? true : false;
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
                    'period' => round((strtotime($offer->expired_at) - strtotime($offer->start_at))/3600/24),
                    'start_date' => $offer->user_valid_from,
                    'expired_date' => $offer->user_valid_until,
                ]);
            endif;

            $this->notify($orderItem);
        }
    }

    private function notify(OrderItem $orderItem): void
    {
        // $orderCourse->user->notify(new NewCourseEnrollmentNotification($orderItem->offer));
    }
}
