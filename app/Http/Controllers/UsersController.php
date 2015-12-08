<?php

namespace App\Http\Controllers;

use App\User;
use App\Order;
use App\Http\Requests;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class UsersController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('admin', ['only' => ['index', 'show']]);
    }

    public function index()
    {
        $users = User::orderBy('name', 'asc')->get();

        return view('users.index', compact('users'));
    }

    public function show($id)
    {
        $user = User::where('id', '=', $id)->with('orders')->first();

        return view('users.show', compact('user'));
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
