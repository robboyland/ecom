@extends('layouts.cms')

@section('content')

    <h1>Edit: {{ $item->name }}</h1>

    @include('common.errors')

    <form action="/items/{{ $item->id }}" method="POST" enctype="multipart/form-data">

        {{ csrf_field() }}
        {{ method_field('PUT') }}

        <div class="form-group">
            <label for="name">name</label>
            <input type="text" name="name" id="name" value="{{ $item->name }}" class="form-control" required>
        </div>

        <select name="category_id" required>
            @foreach($categories as $cat)
                <option value="{{ $cat->id }}"
                @if ($item->category_id == $cat->id) {{ 'selected' }} @endif >{{ $cat->name }}</option>
            @endforeach
        </select>

        <div class="form-group">
            <label for="description">description</label>
            <textarea name="description" id="description" class="form-control" required>{{ $item->description }}</textarea>
        </div>

        <div class="form-group">
            <label for="cost">cost</label>
            <input type="text" name="cost" id="cost" value="{{ $item->cost }}" class="form-control" required>
        </div>

        <div class="form-group">
            <input type="file" name="image" id="image">
        </div>

        <div class="form-group">
            <input type="submit" value="Update Item" class="btn btn-primary">
        </div>

    </form>
@stop
