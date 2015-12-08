@extends('layouts.cms')

@section('content')

    <h1>Order reference: {{ $order->id }} {{ $order->paid }}</h1>
    <hr />
    <p>{{ $order->created_at->format('l jS F Y h:i:s A') }}</p>
    <hr />

    <h3>Items:</h3>
    <ol>
    @foreach ($order->orderItems as $item)
        <li>{{ $item->name }} | Qty: {{ $item->quantity }} | &pound;{{ $item->price / 100 }}</li>
    @endforeach
    </ol>

    <hr />
    <h2>Order Total: &pound;{{ $order->total / 100 }}</h2>
    <hr />

    <h2>{{ $user->name }}</h2>
    <ul>
        <li>{{ $user->name_number }}</li>
        <li>{{ $user->street }}</li>
        <li>{{ $user->town_city }}</li>
        <li>{{ $user->county }}</li>
        <li>{{ $user->postcode }}</li>
    </ul>
@stop
