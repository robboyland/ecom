@extends('layouts.default')

@section('content')

<div class="col-md-6 col-md-offset-3">

    <h3>Account Email: {{ Auth::user()->email }}</h3>
    <h3>Order Total: £{{ $cartTotal / 100}}</h3>

    @if (session('alert'))
        <div class="alert alert-danger">
            {{ session('alert') }}
        </div>
    @endif

    <form action="/checkout/charge" method="post" id="payment-form">

        {{ csrf_field() }}

        <span class="payment-errors"></span>

        <div class="form-group">
          <label>
            <span>Card Number</span>
            <input type="text" size="20" data-stripe="number"/>
          </label>
        </div>

        <div class="form-group">
          <label>
            <span>CVC</span>
            <input type="text" size="4" data-stripe="cvc"/>
          </label>
        </div>

        <div class="form-group">
          <label>
            <span>Expiration (MM/YYYY)</span>
            <input type="text" size="2" data-stripe="exp-month"/>
          </label>
          <span> / </span>
          <input type="text" size="4" data-stripe="exp-year"/>
        </div>

        <div class="form-group">
            <input type="submit" value="Buy" class="btn btn-primary">
        </div>

    </form>



      <!-- The required Stripe lib -->
  <script type="text/javascript" src="https://js.stripe.com/v2/"></script>

  <!-- jQuery is used only for this example; it isn't required to use Stripe -->
  <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>


   <script type="text/javascript">
    // This identifies your website in the createToken call below
    Stripe.setPublishableKey('pk_test_1efG6spSZWlI6DlRmdZ3gN91');

    // var stripeResponseHandler = function(status, response) {
    //   var $form = $('#payment-form');

    //   if (response.error) {
    //     // Show the errors on the form
    //     $form.find('.payment-errors').text(response.error.message);
    //     $form.find('button').prop('disabled', false);
    //   } else {
    //     // token contains id, last4, and card type
    //     var token = response.id;
    //     // Insert the token into the form so it gets submitted to the server
    //     $form.append($('<input type="hidden" name="stripeToken" />').val(token));
    //     // and re-submit
    //     $form.get(0).submit();
    //   }
    // };

    // jQuery(function($) {
    //   $('#payment-form').submit(function(e) {
    //     var $form = $(this);

    //     // Disable the submit button to prevent repeated clicks
    //     $form.find('button').prop('disabled', true);

    //     Stripe.card.createToken($form, stripeResponseHandler);

    //     // Prevent the form from submitting with the default action
    //     return false;
    //   });
    // });
  </script>
</div>
@stop
