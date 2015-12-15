@extends('layouts.default')

@section('content')

    <h1>Reset Password</h1>

    @include('common.errors')

    <form action="/password/reset" method="POST" >

    {!! csrf_field() !!}

    <input type="hidden" name="token" value="{{ $token }}">

    <div class="form-group">
        <label for="email">email</label>
        <input type="text" name="email" value="{{ old('email') }}" id="email" class="form-control">
    </div>

    <div class="form-group">
        <label for="password">password</label>
        <input type="password" id="password" name="password" class="form-control">
    </div>

    <div class="form-group">
        <label for="confirm_password">Confirm password</label>
        <input type="password" id="confirm_password" name="password_confirmation" class="form-control">
    </div>

    <div class="form-group">
        <input type="submit" value="Reset Password" class="btn btn-primary">
    </div>
</form>
@stop
