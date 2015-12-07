@extends('layouts.default')

@section('content')

    <div><a href="/categories/create">Add New Category</a></div>

    <h1>Categories</h1>

    @foreach ($categories as $category)
        <div><a href="categories/{{ $category->id }}/edit">{{ $category->name }}</a></div>
    @endforeach
@stop
