@extends('layouts.cms')

@section('content')

    <h1>Add New Category</h1>

    @include('common.errors')

    <form action="/categories" method="POST">

        {{ csrf_field() }}

        <div class="form-group">
            <label for="name">name</label>
            <input type="text" name="name" id="name" class="form-control" required>
        </div>

        <div class="form-group">
            <input type="submit" value="Add New Category" class="btn btn-primary">
        </div>

    </form>
@stop
