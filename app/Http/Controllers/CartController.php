<?php

namespace App\Http\Controllers;

use Ecom\Cart\Cart;
use App\Http\Requests;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Session;

class CartController extends Controller
{
    public function __construct(Cart $cart)
    {
        $this->cart = $cart;
    }

    public function index()
    {
        if ( ! Session::has('cart')) Session::put('cart', []);

        $cart = $this->cart->all();
        $total = $this->cart->totalCost();

        return view('cart.cart', compact('cart', 'total'));
    }

    public function store(Request $request)
    {
        $this->cart->add($request->input('id'),
                         $request->input('name'),
                         1,
                         $request->input('price')
                     );

        return redirect('cart');
    }

    public function destroy($id)
    {
        $this->cart->removeItem($id);

        return redirect('cart')->with('flash_message', 'Item Removed');
    }
}
