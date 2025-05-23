<?php

namespace Modules\Order\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Modules\Order\Entities\OrderStatus;

class OrderStatusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::beginTransaction();
        try {
            $all = [
                [
                    'flag' => 'pending',
                    'color_label' => json_encode(["text" => "danger", "value" => "#f8d7da"]),
                    'success_status' => 0,
                    'failed_status'=>1,
                    'title' => [
                        'ar' => 'جارى الإنتظار	',
                        'en' => 'Pending',
                    ],
                ],
                [
                    'flag' => 'refund',
                    'color_label' => json_encode(["text" => "danger", "value" => "#F8D7DA"]),
                    'success_status' => 0,
                    'failed_status'=>1,
                    'title' => [
                        'ar' => 'تم استرجاع الطلب',
                        'en' => 'Order Refund',
                    ],
                ],
                [
                    'flag' => 'success',
                    'color_label' => json_encode(["text" => "success", "value" => "#D4EDDA"]),
                    'success_status' => 1,
                    'failed_status'=>0,
                    'title' => [
                        'ar' => 'تم الطلب بنجاح',
                        'en' => 'Order was successfully',
                    ],
                ],
                [
                    'flag' => 'failed',
                    'color_label' => json_encode(["text" => "danger", "value" => "#F8D7DA"]),
                    'success_status' => 0,
                    'failed_status'=>1,
                    'title' => [
                        'ar' => 'فشلت محاولة الطلب',
                        'en' => 'Order Failed',
                    ],
                ],
                [
                    'flag' => 'delivered',
                    'color_label' => json_encode(["text" => "success", "value" => "#D4EDDA"]),
                    'success_status' => 1,
                    'failed_status'=>0,

                    'title' => [
                        'ar' => 'تم التوصيل',
                        'en' => 'Delivered',
                    ],
                ],
                [
                    'flag' => 'cancelled',
                    'color_label' => json_encode(["text" => "danger", "value" => "#F8D7DA"]),
                    'success_status' => 0,
                    'failed_status'=>1,
                    'title' => [
                        'ar' => 'تم إلغاء الطلب',
                        'en' => 'Order Cancelled',
                    ],
                ],
                [
                    'flag' => 'new_order',
                    'color_label' => json_encode(["text" => "success", "value" => "#D4EDDA"]),
                    'success_status' => 1,
                    'failed_status'=>0,
                    'title' => [
                        'ar' => 'طلب جديد',
                        'en' => 'New Order',
                    ],
                ],
            ];

            foreach ($all as $k => $status) {
                $s = OrderStatus::create($status);
            }

            DB::commit();
        } catch (\Exception $e) {
            DB::rollback();
            throw $e;
        }
    }
}
