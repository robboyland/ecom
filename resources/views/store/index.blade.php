@extends('layouts.default')

@section('content')

    @foreach ($items as $item)
        <a href="/{{ $item->id }}"><h2>{{ $item->name }}</h2></a>
    @endforeach
@stop
