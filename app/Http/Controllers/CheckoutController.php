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

            // Fire event here or order processor
            // Event::fire('purchase.made');
            // email customer
            // email admin
            // create receipt

            return redirect('dashboard')->with('flash_message', 'Order Completed!');
        }

        catch(\Stripe\Error\Card $e)
        {
            $body = $e->getJsonBody();
            $error  = $body['error'];

            return redirect('checkout/payment')->with('alert', $error['message']);
        }

        # TODO:
        // other errors
        # log them
        # email notification
        # text message - for critical

        // } catch (\Stripe\Error\RateLimit $e) {
        //   // Too many requests made to the API too quickly
        // } catch (\Stripe\Error\InvalidRequest $e) {
        //   // Invalid parameters were supplied to Stripe's API
        // } catch (\Stripe\Error\Authentication $e) {
        //   // Authentication with Stripe's API failed
        //   // (maybe you changed API keys recently)
        // } catch (\Stripe\Error\ApiConnection $e) {
        //   // Network communication with Stripe failed
        // } catch (\Stripe\Error\Base $e) {
        //   // Display a very generic error to the user, and maybe send
        //   // yourself an email
        // } catch (Exception $e) {
        //   // Something else happened, completely unrelated to Stripe
        // }
    }

}
