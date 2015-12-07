@extends('layouts.default')

@section('content')

    <div><a href="/items/create">Add New Item</a></div>

    <h1>Items</h1>

    @foreach ($items as $item)
        <div><a href="items/{{$item->id}}/edit">{{ $item->name }}</a></div>
    @endforeach
@stop
