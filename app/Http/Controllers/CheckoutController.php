<?php

namespace App\Http\Controllers;

use App\User;
use Carbon\Carbon;
use Ecom\Cart\Cart;
use App\Http\Requests;
use Illuminate\Http\Request;
use Ecom\Service\OrderProcessor;
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

        $months = ['01', '02', '03', '04', '05', '06', '07', '08', '09', '10', '11', '12'];

        $years = range(Carbon::now()->format('Y'), Carbon::now()->addYear(10)->format('Y'));

        return view('checkout.card-details', compact('cartTotal', 'years', 'months'));
    }

    public function charge(Request $request)
    {
        try {
            $this->orderProcessor->charge($request->user(), $request->input('stripeToken'));

            return redirect('dashboard')->with('flash_message', 'Order Completed!');

        } catch(\Stripe\Error\Card $e) {
            $body = $e->getJsonBody();
            $error  = $body['error'];

            return redirect('checkout/payment')->with('alert', $error['message']);

        } catch (\Stripe\Error\RateLimit $e) {
            return redirect('checkout/payment')->with('alert', 'It looks like our payment processor was busy. Please try again.');

        } catch (\Stripe\Error\InvalidRequest $e) {
            return redirect('checkout/payment')->with('alert', $e->getMessage());

        } catch (\Stripe\Error\Authentication $e) {
            return redirect('checkout/payment')->with('alert', $e->getMessage());

        } catch (\Stripe\Error\ApiConnection $e) {
            return redirect('checkout/payment')->with('alert', $e->getMessage());

        } catch (\Stripe\Error\Base $e) {
            return redirect('checkout/payment')->with('alert', $e->getMessage());
        }
    }

}
