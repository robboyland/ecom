@extends('layouts.default')

@section('content')

    <h1>{{ $item->name }}</h1>
    <p>{{ $item->description }}</p>
    <div>{{ $item->cost }}</div>
@stop
