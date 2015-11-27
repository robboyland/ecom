@extends('layouts.default')

@section('content')

    <div><a href="/categories/create">Add New Category</a></div>

    <h1>Categories</h1>

    @foreach ($categories as $category)
        <h2>{{ $category->name }}</h2>
    @endforeach
@stop
