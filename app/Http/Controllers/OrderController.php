<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function index()
    {
        $orders = Order::query()->where('user_id', auth()->user()->id);

        if (request('status')) {
            $orders->where('status', request('status'));
        }

        $orders = $orders->get();

        for ($i = 1; $i <= 5; $i++) {
            $ordersByStatus[$i] = Order::where('user_id', auth()->user()->id)->where('status', $i)->count();
        }

        return view('orders.index', compact('orders', 'ordersByStatus'));
    }

    public function show(Order $order)
    {
        $this->authorize('view', $order);

        $items = json_decode($order->content);
        $envio = json_decode($order->envio);

        return view('orders.show', compact('order', 'items', 'envio'));
    }

    public function destroy(Order $order)
{
    $this->authorize('delete', $order); 

    try {
        $order->delete();
        return redirect()->route('orders.index')->with('success', 'Order deleted successfully.');
    } catch (\Exception $e) {
        return redirect()->route('orders.index')->with('error', 'Error deleting order.');
    }
}
}
