@extends('layouts.default')

@section('content')

    <div class="col-md-10 col-md-offset-1">

        <img class="img-responsive" src="http://placehold.it/700x400" alt="">
        <h1>{{ $item->name }}</h1>
        <p>{{ $item->description }}</p>
        <div>{{ $item->cost }}</div>

        <form action="/cart/store" method="POST">

                {{ csrf_field() }}

                <input name="_method" type="hidden" value="DELETE">
                <input type="hidden" name="name" value="{{ $item->name }}">
                <input type="hidden" name="id" value="{{ $item->id }}">
                <input type="hidden" name="price" value="{{ $item->cost }}">

            <div class="form-group">
                <input type="submit" value="Add to cart " class="btn btn-primary btn-sm">
            </div>
        </form>

    </div>
@stop
