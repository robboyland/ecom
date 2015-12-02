<?php

namespace Ecom\Billing;

class StripeBilling implements BillingInterface
{
    public function __construct()
    {
        \Stripe\Stripe::setApiKey(getenv('STRIPE_SECRET_KEY'));
    }

    public function charge(array $data)
    {
        try
        {
            return \Stripe\Charge::create([
                        'amount' => $data['amount'],
                        'currency' => 'gbp',
                        'description' => $data['email'],
                        'card' => $data['token']
                    ]);
        }

        catch(\Stripe\Error\Card $e)
        {
            $e_json = $e->getJsonBody();
            $error = $e_json['error'];
            $errors = json_decode($error);

            return view('stripe.card-declined', compact('error'));
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
