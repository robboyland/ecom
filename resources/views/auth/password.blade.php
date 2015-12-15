@extends('layouts.default')

@section('content')

    <h1>Password Reset Link</h1>

    @include('common.errors')

    <form action="/password/email" method="POST">

        {!! csrf_field() !!}

        <div class="form-group">
            <label for="email">email</label>
            <input type="text" name="email" value="{{ old('email') }}" id="email" class="form-control">
        </div>

        <div class="form-group">
            <input type="submit" value="Send Password Reset Link" class="btn btn-primary">
        </div>
    </form>
@stop
