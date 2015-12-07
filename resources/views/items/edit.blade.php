@extends('layouts.default')

@section('content')

    <h1>Edit: {{ $item->name }}</h1>

    <form action="/items/{{ $item->id }}" method="POST">

        {{ csrf_field() }}
        {{ method_field('PUT') }}

        <div class="form-group">
            <label for="name">name</label>
            <input type="text" name="name" id="name" value="{{ $item->name }}" class="form-control">
        </div>

        <select name="category_id">
            @foreach($categories as $cat)
                <option value="{{ $cat->id }}"
                @if ($item->category_id == $cat->id) {{ 'selected' }} @endif >{{ $cat->name }}</option>
            @endforeach
        </select>

        <div class="form-group">
            <label for="description">description</label>
            <textarea name="description" id="description" class="form-control">{{ $item->description }}</textarea>
        </div>

        <div class="form-group">
            <label for="cost">cost</label>
            <input type="text" name="cost" id="cost" value="{{ $item->cost }}" class="form-control">
        </div>

        <div class="form-group">
            <input type="submit" value="Update Item" class="btn btn-primary">
        </div>

    </form>
@stop
