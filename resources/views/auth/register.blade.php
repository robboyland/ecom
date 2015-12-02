@extends('layouts.default')

@section('content')

    <h1>Register</h1>

    <form method="POST" action="/auth/register">

    {!! csrf_field() !!}

    <div class="form-group">
        <label for="name">name</label>
        <input type="text" name="name" value="{{ old('name') }}" id="name" class="form-control">
    </div>

    <div class="form-group">
        <label for="email">email</label>
        <input type="text" name="email" value="{{ old('email') }}" id="email" class="form-control">
    </div>

    <div class="form-group">
        <label for="password">password</label>
        <input type="text" name="password" class="form-control">
    </div>

    <div class="form-group">
        <label for="password_confirmation">password_confirmation</label>
        <input type="text" name="password_confirmation" id="password_confirmation" class="form-control">
    </div>

    <div class="form-group">
        <input type="submit" value="Register" class="btn btn-primary">
    </div>
</form>

@stop
