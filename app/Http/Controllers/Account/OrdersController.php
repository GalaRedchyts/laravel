<?php

namespace App\Http\Controllers\Account;

use App\Http\Controllers\Controller;
use App\Http\Requests\UpdateOrderRequest;
use App\Models\Order;
use App\Models\OrderStatus;

class OrdersController extends Controller
{
    public function __invoke()
    {
        $orders = Order::with(['user', 'status'])->orderByDesc('id')->paginate(10);

        return view('account/orders/index', compact('orders'));
    }
}
