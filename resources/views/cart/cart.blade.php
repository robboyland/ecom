@extends('layouts.default')

@section('content')

        <div class="cart row col-md-12 col-md-offset-2">

        <div class="col-xs-8">

            <div class="panel panel-info">

                <div class="panel-heading">
                    <div class="panel-title">
                        <div class="row">
                            <div class="col-xs-6">
                                <h5><span class="glyphicon glyphicon-shopping-cart"></span> Shopping Cart</h5>
                            </div>
                            <div class="col-xs-6">

                                    <a href="/" class="btn btn-primary btn-sm btn-block">
                                        <span class="glyphicon glyphicon-share-alt"></span>
                                    Continue shopping</a>
                            </div>
                        </div>
                    </div>
                </div>



                <div class="panel-body">

 <!-- start row -->


                @foreach($cart as $k => $item)

                    <div class="row">
                        <div class="col-xs-3"><img class="img-responsive" src="http://placehold.it/140x100">
                        </div>
                        <div class="col-xs-4">
                            <h4 class="product-name"><strong>{{ $item['name'] }}</strong></h4>
                        </div>
                        <div class="col-xs-5">
                            <div class="col-xs-5 text-right">
                                <h6><strong>£{{ $item['price'] / 100 }} <span class="text-muted">x</span></strong></h6>
                            </div>
                            <div class="col-xs-4">

                                <input type="text" class="form-control input-sm" value="{{ $item['qty'] }}">

                            </div>
                            <div class="col-xs-2">
                                <form action="cart/{{ $k }}" method="POST">
                                    {{ csrf_field() }}
                                    {{ method_field('DELETE') }}
                                    <button type="submit" id="delete-item-{{ $k }}">
                                    <span class="glyphicon glyphicon-trash">

                                    </span>
                                </button>
                                </form>
                                </button>
                            </div>
                        </div>
                    </div>
                    <hr>

                @endforeach

 <!-- end row -->

                    <div class="row">
                        <div class="text-center">
                            <div class="col-xs-9">
                                <h6 class="text-right">Added items?</h6>
                            </div>
                            <div class="col-xs-3">
                                <button type="button" class="btn btn-default btn-sm btn-block">
                                    Update cart
                                </button>
                            </div>
                        </div>
                    </div>

                </div> <!-- end panel-body -->

                <div class="panel-footer">
                    <div class="row text-center">
                        <div class="col-xs-9">
                            <h4 class="text-right">Total <strong>£{{ $total / 100 }}</strong></h4>
                        </div>
                        <div class="col-xs-3">
                            <a href="checkout/customer">
                                <button type="button" class="btn btn-success btn-block">
                                    Checkout
                                </button>
                            </a>
                        </div>
                    </div>
                </div>

            </div> <!-- div.panel panel-info -->

        </div> <!-- col-xs-8 -->

    </div> <!-- div.cart -->

@stop
