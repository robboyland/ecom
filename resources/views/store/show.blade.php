@extends('layouts.default')

@section('content')

    <div class="col-md-10 col-md-offset-1">

        {!! image($item) !!}

        <h1>{{ $item->name }}</h1>
        <p>{{ $item->description }}</p>
        <div>{{ $item->cost }}</div>

        <form action="/cart" method="POST">

                {{ csrf_field() }}

                <input type="hidden" name="name" value="{{ $item->name }}">
                <input type="hidden" name="id" value="{{ $item->id }}">
                <input type="hidden" name="price" value="{{ $item->cost }}">

            <div class="form-group">
                <input type="submit" value="Add to cart " class="btn btn-primary btn-sm">
            </div>
        </form>

    </div>
@stop
