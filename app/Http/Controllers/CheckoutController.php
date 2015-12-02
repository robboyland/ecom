<?php

namespace App\Http\Controllers;

use Ecom\Cart\Cart;
use Ecom\Service\OrderProcessor;

use App\User;
use App\Http\Requests;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class CheckoutController extends Controller
{
    public function __construct(Cart $cart, OrderProcessor $orderProcessor)
    {
        $this->cart = $cart;
        $this->orderProcessor = $orderProcessor;

        $this->middleware('auth', ['except' => ['details', 'register']]);
    }

    public function details()
    {
        if (Auth::check()) return redirect('checkout/payment');

        return view('checkout.details');
    }

    public function register(Request $request)
    {
        $user = User::create($request->all());

        Auth::loginUsingId($user->id);

        return redirect('checkout/payment');
    }

    public function payment()
    {
        $cartTotal = $this->cart->totalCost();

        return view('checkout.card-details', compact('cartTotal'));
    }

    public function charge(Request $request)
    {
        $this->orderProcessor->charge($request->user(), $request->input('stripeToken'));

        // Fire event here or order processor
        // Event::fire('purchase.made');
        // email customer
        // email admin
        // create receipt

        return view('checkout.confirmation');
    }

}
