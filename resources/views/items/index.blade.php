@extends('layouts.default')

@section('content')

    <div><a href="/items/create">Add New Item</a></div>

    <h1>Items</h1>

    @foreach ($items as $item)
        <div>
            <a href="items/{{$item->id}}/edit">{{ $item->name }}</a>
            <form action="items/{{ $item->id }}" method="POST">
                {{ csrf_field() }}
                {{ method_field('DELETE') }}
                <div class="form-group">
                    <input type="submit" id="delete-item-{{ $item->id }}" value="Delete Item" class="btn btn-xs btn-danger">
                </div>
            </form>
        </div>
    @endforeach
@stop
