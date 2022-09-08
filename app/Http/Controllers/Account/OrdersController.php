<?php

namespace App\Http\Controllers\Account;

use App\Http\Controllers\Controller;
use App\Http\Requests\UpdateOrderRequest;
use App\Models\Order;
use App\Models\OrderStatus;

class OrdersController extends Controller
{
//    public function index()
//    {
//        $orders = Order::with(['user', 'status'])->orderByDesc('id')->paginate(10);
////            ->sortable(['created_at' => 'asc'])
////            ->paginate(10);
//
//        return view('account/orders/index', compact('orders'));
//    }
//
//    public function edit(Order $order)
//    {
//        $statuses = OrderStatus::all();
//        $products = $order->products()->get();
//        return view('account/orders/edit', compact('order', 'products', 'statuses'));
//    }
//
//    public function update(UpdateOrderRequest $request, Order $order)
//    {
//        $order->update($request->validated());
//
//        return redirect()->back()->with(['session' => 'Order was updated!']);
//    }

    public function __invoke()
    {
        return view('account/orders/index');
    }
}
