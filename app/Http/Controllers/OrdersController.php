<?php

namespace App\Http\Controllers;

use App\User;
use App\Order;
use App\Http\Requests;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class OrdersController extends Controller
{
    public function __construct()
    {
        $this->middleware('admin', ['except' => 'show']);
    }

    public function index()
    {
        $orders = Order::all();

        return view('orders.index', compact('orders'));
    }

    public function show($id)
    {
        $order = Order::where('id', '=', $id)->with('OrderItems')->first();

        if (! Auth::user()->admin == "1" || ! Auth::user()->id == $order->user_id) {
            return redirect('/dashboard');
        }

        $user = User::where('id', '=', $order->user_id)->first();

        return view('orders.show', compact('order', 'user'));
    }
}
