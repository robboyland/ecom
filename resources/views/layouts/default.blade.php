<!DOCTYPE html>
<html>
<head>
    <title>test</title>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->

    <script src="http://code.jquery.com/jquery-1.10.1.min.js"></script>

    <link href="//maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css" rel="stylesheet">
    <script src="//maxcdn.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"></script>


    <link rel="stylesheet" href="{!! asset('css/styles.css') !!}"  type="text/css">
    <script src="{{ asset('/js/javascript.js') }}"></script>
</head>
<body>
    <div class="container">
        <nav class="navbar navbar-default">
  <div class="container-fluid">
    <!-- Brand and toggle get grouped for better mobile display -->
    <div class="navbar-header">
      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
      <a class="navbar-brand" href="#">Ecom</a>
    </div>

    <!-- Collect the nav links, forms, and other content for toggling -->
    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
      <ul class="nav navbar-nav">
        <li><a href="/">Home</a></li>
      </ul>
      <form class="navbar-form navbar-left" role="search">
        <div class="form-group">
          <input type="text" class="form-control" placeholder="Search">
        </div>
        <button type="submit" class="btn btn-default">Submit</button>
      </form>
      <ul class="nav navbar-nav navbar-right">
        <li><a href="/cart">Cart</a></li>
        @if ( ! Auth::check())
            <li><a href="/auth/register">Register</a></li>
            <li><a href="/auth/login">Login</a></li>
        @else
            @if (Auth::user()->admin)
                <li><a href="/cms">cms</a></li>
            @else
                <li><a href="/dashboard">dashboard</a></li>li>
            @endif
            <li><a href="/auth/logout">Logout</a></li>
        @endif
      </ul>
    </div><!-- /.navbar-collapse -->
  </div><!-- /.container-fluid -->
</nav>
        <!-- <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <a href="/">home</a>
            </div>
        </div> -->
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
            @yield('content')
            </div>
        </div>
    </div>
</body>
</html>