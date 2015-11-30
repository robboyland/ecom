@extends('layouts.default')

@section('content')

    @foreach(array_chunk($items->all(), 3) as $row)
        <div class="row">
            @foreach($row as $item)
            <div class="gallery-item col-md-4 portfolio-item">
                <a href="/{{ $item->id }}">
                    <img class="img-responsive" src="http://placehold.it/700x400" alt="">
                </a>
                <h2>{{ $item->name }}</h2>
                <div>&pound; {{ $item->price / 100 }}</div>
            <div>

                <form action="/cart/store" method="POST">

                    {{ csrf_field() }}
                    <input name="_method" type="hidden" value="DELETE">
                    <input type="hidden" name="name" value="{{ $item->name }}">
                    <input type="hidden" name="id" value="{{ $item->id }}">
                    <input type="hidden" name="price" value="{{ $item->price }}">

                <div class="form-group">
                    <input type="submit" value="Add to cart " class="btn btn-primary btn-sm">
                </div>

                </form>
            </div>
                <p>{{ $item->description }}</p>
            </div>
            @endforeach
        </div>
    @endforeach
@stop
