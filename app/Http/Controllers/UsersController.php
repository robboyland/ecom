<?php

namespace App\Http\Controllers;

use App\Order;
use App\Http\Requests;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class UsersController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function dashboard(Request $request)
    {
        $orders = Order::where('user_id', '=', $request->user()->id)
                ->orderBy('created_at')
                ->with('orderItems')
                ->get();

        return view('users.dashboard', compact('orders'));
    }

}
