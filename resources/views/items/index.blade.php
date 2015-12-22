@extends('layouts.cms')

@section('content')

    <div><a href="/items/create" class="btn btn-primary">Add New Item</a></div>

    <h1>Items</h1>

    @foreach(array_chunk($items->all(), 3) as $row)
        <div class="row">
            @foreach($row as $item)
            <div class="gallery-item col-md-4 portfolio-item">

                <a href="/{{ $item->id }}">
                    {!! image($item) !!}
                </a>

                <h2>{{ $item->name }}</h2>

                <div>
                    <a href="items/{{$item->id}}/edit" class="btn btn-xs btn-primary" style="float: left"> edit </a>

                    <form action="items/{{ $item->id }}" method="POST" style="float: right">
                        {{ csrf_field() }}
                        {{ method_field('DELETE') }}
                        <div class="form-group">
                            <input type="submit" id="delete-item-{{ $item->id }}" value="Delete Item" class="btn btn-xs btn-danger">
                        </div>
                    </form>
                </div>

                <div style="clear:both">
                    <div>&pound; {{ $item->cost / 100 }}</div>

                    <p>{{ $item->description }}</p>
                    </div>
            </div>
            @endforeach
        </div>
    @endforeach
@stop
