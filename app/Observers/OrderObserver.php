<?php

namespace App\Observers;

use App\Models\Order;
use App\Notifications\OrderStatusChangedNotification;

class OrderObserver
{
    public function updated(Order $order)
    {
        if($order->status_id !== $order->getOriginal('status_id')) {
            $order->notify(
                (new OrderStatusChangedNotification($order))->onQueue('telegram')
            );
        }
    }
}
