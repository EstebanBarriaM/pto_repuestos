<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Order;

class OrderController extends Controller
{
    public function index(Request $request)
    {
        $orders = Order::all();

        foreach ($orders as $order) {
            $items = [];

            foreach ($order->orderItems as $orderItem) {
                array_push($items, [
                    'product' => $orderItem->product->name,
                    'quantity' => $orderItem->quantity,
                    'price' => '$' . $orderItem->product->price
                ]);
            }

            $order['customer'] = $order->user->full_name;
            $order['items'] = $items;
        }

        return view('backend.sections.orders.index', compact('orders'));
    }

    public function destroy($id)
    {
        $order = Order::with('orderItems')->find($id);
        $order->orderItems()->delete();
        $order->delete();

        return redirect()->back()->with('flash', 'Compra eliminada exitosamente!');
    }
}
