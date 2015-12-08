@extends('layouts.cms')

@section('content')

    <h2>{{ $user->name }}</h2>
    <hr />
    <ul>
        <li>{{ $user->name_number }}</li>
        <li>{{ $user->street }}</li>
        <li>{{ $user->town_city }}</li>
        <li>{{ $user->county }}</li>
        <li>{{ $user->postcode }}</li>
    </ul>

    <h2>Orders</h2>
    <hr />
    @foreach ($user->orders as $order)
        <div><a href="/orders/{{ $order->id }}">id: {{ $order->id }} : &pound;{{ $order->total }} : {{ $order->created_at->format('l jS F Y h:i:s A') }}</a></div>
    @endforeach
@stop
