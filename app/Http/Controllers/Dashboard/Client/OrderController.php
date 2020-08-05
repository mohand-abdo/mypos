<?php

namespace App\Http\Controllers\Dashboard\Client;

use App\Modeles\Order;
use App\Modeles\Client;
use App\Modeles\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\Dashboard\Orders\CreateRequest;
use App\Modeles\Product;

class OrderController extends Controller
{

    public function create(Client $client)
    {
        $categories = Category::get();
        $orders = $client->orders()->latest()->take(5)->get();
        return view('dashboard.clients.orders.create', compact('client', 'categories', 'orders'));
    }

    public function store(CreateRequest $request, Client $client)
    {
        $this->attach_order($request, $client);
        return redirect()->route('dashboard.orders.index')->with('message', __('dashboard.added_successfullu'));
    }

    public function edit(Client $client, Order $order)
    {
        $categories = Category::get();
        $orders = $client->orders()->latest()->take(5)->get();
        return view('dashboard.clients.orders.edit', compact('client', 'order', 'categories', 'orders'));
    }

    public function update(Request $request, Client $client, Order $order)
    {
        $this->detach_order($order);
        $this->attach_order($request, $client);
        return redirect()->route('dashboard.orders.index')->with('message', __('dashboard.updated_successfullu'));
    }


    public function attach_order($request, $client)
    {
        $order = $client->orders()->create([]);
        $price = 0;
        $order->products()->attach($request->products);
        foreach ($request->products as $key => $qty) {
            $product = Product::find($key);
            $price += $product->sale_price * $qty['quantity'];
            $product->update([
                'stock' => $product->stock - $qty['quantity']
            ]);
        }

        $order->update([
            'total_price' => $price
        ]);
    }

    public function detach_order($order)
    {
        foreach ($order->products as $product) {
            $product->update([
                'stock' => $product->stock + $product->pivot->quantity
            ]);
        }
        $order->delete();
    }
}
