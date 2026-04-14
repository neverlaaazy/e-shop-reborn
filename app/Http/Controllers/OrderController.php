<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function show()
    {
        $order = Order::inRandomOrder()->first();
        return view('orders.show', compact('order'));
    }
}
