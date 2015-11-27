@extends('layouts.default')

@section('content')

    <div><a href="/items/create">Add New Item</a></div>

    <h1>Items</h1>

    @foreach ($items as $item)
        <div>{{ $item->name }}</div>
    @endforeach
@stop
