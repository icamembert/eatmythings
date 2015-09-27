@extends('app')

@section('content')

    <!-- WRAPPER -->
    <div id="wrapper">

        <div id="shop">

            <!-- PAGE TITLE -->
            <header id="page-title">
                <div class="container">
                    <h1>Hungry Cart</h1>

                    <ul class="breadcrumb">
                        <li><a href="{{ action('HomeController@index') }}">Home</a></li>
                        <li class="active">My Cart</li>
                    </ul>
                </div>
            </header>


            <section class="container">

                    <h2>Hungry Cart</h2>
                    <form class="white-row" method="post" action="#">

                        <!-- cart content -->
                        <div id="cartContent">
                            <!-- cart header -->
                            <div class="item head">
                                <span class="cart_img"></span>
                                <span class="product_name fsize13 bold">DISH NAME</span>
                                <span class="remove_item fsize13 bold"></span>
                                <span class="total_price fsize13 bold">TOTAL</span>
                                <span class="qty fsize13 bold">QUANTITY</span>
                                <div class="clearfix"></div>
                            </div>
                            <!-- /cart header -->

                            @foreach (Cart::content() as $item)
                                <!-- cart item -->
                                <div class="item">
                                    <div class="cart_img"><img src="{{ asset('/userdata/' . $item->options->chefId . '/dishes/' . $item->id . '/picture_sm.jpg') }}" width="40" alt="Dish Picture" /></div>
                                    <a href="{{ action('DishesController@show', array('dishes' => $item->options->dish, 'isBeingOrdered' => 0)) }}" class="product_name">{{ $item->name }}</a>
                                    <a href="#" class="remove_item">X</a>
                                    <div class="total_price"><span>{{ $item->price }}</span></div>
                                    <div class="qty"><input type="text" value="{{ $item->qty }}" name="qty" maxlength="3" /> x {{ $item->price }}</div>
                                    <div class="clearfix"></div>
                                </div>
                                <!-- /cart item -->
                            @endforeach

                            <!-- cart total -->
                            <div class="total pull-right">

                                <span class="totalToPay styleSecondColor">
                                    TOTAL: {{ Cart::total() }}
                                </span>

                            </div>
                            <!-- /cart total -->


                            <!-- update cart -->
                            <a href="{{ action('OrdersController@create') }}" class="btn_update btn btn-primary btn-md pull-right">Order</a>
                            <!-- /update cart -->

                            <div class="clearfix"></div>
                        </div>
                        <!-- /cart content -->

                    </form>

                </section>

        </div>
    </div>
    <!-- /WRAPPER -->

    @include('partials._footer')

    

@endsection

@section('afterScripts')
    <script>

        /*$('#dishQuantityBlock').hide();
        $('#addToCartButton').click(function() {
            $(this).hide();
            $('#dishQuantityBlock').show(400);
        });

        var price = ;
        $('#totalPrice').html($('#quantity').val() * price);*/

        $(function () {
            $('#datetimepicker').datetimepicker({
                format: 'YYYY-MM-DD HH:mm:00'
                //daysOfWeekDisabled: [0, 6]
            });
        });

        function updateTotalPrice(quantity) {
            $('#totalPrice').html(quantity * price);
        }

       
    </script>
@endsection