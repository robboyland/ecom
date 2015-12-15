@extends('layouts.cms')

@section('content')

    <h1>Add New Item</h1>

    @include('common.errors')

    <form action="/items" method="POST" enctype="multipart/form-data">

        {{ csrf_field() }}

        <div class="form-group">
            <label for="name">name</label>
            <input type="text" name="name" id="name" value="{{ old('name') }}" class="form-control" required>
        </div>

        <select name="category_id" required>
                <option selected disabled>Select Category</option>
            @foreach($categories as $cat)
                <option value="{{ $cat->id }}">{{ $cat->name }}</option>
            @endforeach
        </select>

        <div class="form-group">
            <label for="description">description</label>
            <textarea name="description" id="description" class="form-control">{{ old('description') }}</textarea>
        </div>

        <div class="form-group">
            <label for="cost">cost</label>
            <input type="text" name="cost" id="cost" value="{{ old('cost') }}" class="form-control" required>
        </div>

        <div class="form-group">
            <input type="file" name="image" id="image">
        </div>

        <div class="form-group">
            <input type="submit" value="Add New Item" class="btn btn-primary">
        </div>

    </form>
@stop
