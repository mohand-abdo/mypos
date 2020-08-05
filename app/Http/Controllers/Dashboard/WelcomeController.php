<?php

namespace App\Http\Controllers\Dashboard;

use App\User;
use App\Modeles\Order;
use App\Modeles\Client;
use App\Modeles\Product;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class WelcomeController extends Controller
{
    public function index()
    {
        $charts = Order::select(DB::raw('month(created_at) as month, sum(total_price) as price'))->groupBy('month')->orderBy('month', 'asc')->get()->toArray();
        if (is_array($charts) && !empty($charts)) {
            for ($i = 1; $i < $charts[0]['month']; $i++)
                $array[$i] = 0;
            $charts = array_merge($array, $charts);
        }
        $users = User::get()->count();
        $orders = Order::select(DB::raw('sum(total_price) as price'))->get()[0];
        $products = Product::get()->count();
        $clients = Client::get()->count();
        // return $orders;
        return view('dashboard.welcome', compact('charts', 'users', 'orders', 'products', 'clients'));
    }
}
