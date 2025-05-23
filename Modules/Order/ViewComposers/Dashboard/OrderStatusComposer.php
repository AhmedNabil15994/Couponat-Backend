<?php

namespace Modules\Order\ViewComposers\Dashboard;

use Modules\Order\Repositories\Dashboard\OrderStatusRepository as OrderStatus;
use Illuminate\View\View;
use Cache;

class OrderStatusComposer
{
    public function __construct(OrderStatus $status)
    {
        $this->statuses =  $status->getAll();
    }

    public function compose(View $view)
    {
        $view->with('statuses', $this->statuses);
    }
}
