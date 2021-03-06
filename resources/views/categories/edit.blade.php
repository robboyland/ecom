@extends('layouts.cms')

@section('content')

    <h1>Update Category: {{ $category->name }}</h1>

    @include('common.errors')

    <form action="/categories/{{ $category->id }}" method="POST">

        {{ csrf_field() }}
        {{ method_field('PUT') }}

        <div class="form-group">
            <label for="name">name</label>
            <input type="text" name="name" id="name" value="{{ $category->name }}" class="form-control" required>
        </div>

        <div class="form-group">
            <input type="submit" value="Update Category Name" class="btn btn-primary">
        </div>

    </form>
@stop
