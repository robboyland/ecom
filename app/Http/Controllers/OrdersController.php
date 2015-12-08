<?php

namespace App\Http\Controllers;

use App\User;
use App\Order;
use App\Http\Requests;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class OrdersController extends Controller
{
    public function __construct()
    {
        $this->middleware('admin');
    }

    public function index()
    {
        $orders = Order::all();

        return view('orders.index', compact('orders'));
    }

    public function show($id)
    {
        $order = Order::where('id', '=', $id)->with('OrderItems')->first();
        $user = User::where('id', '=', $order->user_id)->first();

        return view('orders.show', compact('order', 'user'));
    }
}
