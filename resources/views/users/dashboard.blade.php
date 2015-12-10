@extends('layouts.default')

@section('content')

    <h1>Orders</h1>

    @foreach ($orders as $order)
        <div>
            <h3>ref: {{ $order->charge_id }} &middot; Total: {{ number_format($order->total / 100, 2, '.', '') }}</h3>
            <ol>
            @foreach ($order->orderitems as $item)
                <li>{{ $item->name }} &middot; Quantity: {{ $item->quantity }} &middot; Price: {{ number_format($item->price / 100, 2, '.', '') }}</li>
            @endforeach
            </ol>
        </div>
    @endforeach
@stop
