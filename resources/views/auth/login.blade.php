@extends('layouts.default')

@section('content')

    <h1>Login</h1>

    @include('common.errors')

    <form method="POST" action="/auth/login">

    {!! csrf_field() !!}

    <div class="form-group">
        <label for="email">email</label>
        <input type="text" name="email" value="{{ old('email') }}" id="email" class="form-control">
    </div>

    <div class="form-group">
        <label for="password">password</label>
        <input type="password" name="password" class="form-control">
    </div>

    <div class="form-group">
        <input type="checkbox" name="remember"> Remember Me
    </div>

    <div class="form-group">
        <input type="submit" value="Login" class="btn btn-primary">
    </div>
</form>

@stop
