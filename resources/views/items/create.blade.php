@extends('layouts.default')

@section('content')

    <h1>Add New Item</h1>

    <form action="/items" method="POST">

        {{ csrf_field() }}

        <div class="form-group">
            <label for="name">name</label>
            <input type="text" name="name" id="name" class="form-control">
        </div>

        <div class="form-group">
            <label for="description">description</label>
            <textarea name="description" id="description" class="form-control"></textarea>
        </div>

        <div class="form-group">
            <label for="cost">cost</label>
            <input type="text" name="cost" id="cost" class="form-control">
        </div>

        <div class="form-group">
            <input type="submit" value="Add New Item" class="btn btn-primary">
        </div>

    </form>
@stop
