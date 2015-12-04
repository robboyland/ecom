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
            <select data-stripe="exp-month">
            @foreach ($months as $month)
                <option value="{{ $month }}">{{ $month }}</option>
            @endforeach
            </select>
          </label>
          <span> / </span>
            <label>
            <select data-stripe="exp-year">
            @foreach ($years as $year)
                <option value="{{ $year }}">{{ $year }}</option>
            @endforeach
            </select>
            </label>
        </div>

        <div class="form-group">
            <input type="submit" value="Buy" class="btn btn-primary">
        </div>

    </form>



      <!-- The required Stripe lib -->
  <script type="text/javascript" src="https://js.stripe.com/v2/"></script>

  <!-- jQuery is used only for this example; it isn't required to use Stripe -->
  <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>


   <script type="text/javascript"> Stripe.setPublishableKey('{{ getenv('STRIPE_PUBLISHABLE_KEY') }}'); </script>
</div>
@stop
