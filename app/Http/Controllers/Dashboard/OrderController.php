<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Modeles\Order;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function index(Request $request)
    {
        $orders = Order::search($request)->latest()->paginate();
        return view('dashboard.orders.index', compact('orders'));
    }

    public function show(Order $order)
    {
        $products = $order->products;
        return view('dashboard.orders.show', compact('order', 'products'));
    }

    public function destroy(Order $order)
    {
        foreach ($order->products as $product) {
            $product->update([
                'stock' => $product->stock + $product->pivot->quantity
            ]);
        }
        $order->delete();
        return back()->with('message', __('dashboard.deleted_successfullu'));
    }
}
