@extends('app')

@section('content')

    <!-- WRAPPER -->
    <div id="wrapper">

        <div id="shop">

            <!-- PAGE TITLE -->
            <header id="page-title">
                <div class="container">
                    <h1>{{ $dish->name  }}</h1>

                    <ul class="breadcrumb">
                        <li><a href="{{ action('HomeController@index') }}">{{ trans('strings.breadHome') }}</a></li>
                        @if ($dish->isMyDish())
                            <li><a href="{{ action('UsersController@edit') }}">{{ trans('strings.breadMyAccount') }}</a></li>
                        @else
                            <li><a href="{{ action('UsersController@show', array('users' => $dish->user)) }}">{{ Lang::get('strings.breadAboutUser', ['userName' => $dish->user->name]) }}</a></li>
                        @endif
                        <li class="active">{{ $dish->name }}</li>
                    </ul>
                </div>
            </header>


            <section class="container">

                @include('partials._flash')

                <h2>{{ trans('strings.dishShowAbout1') }}</h2>
                

                    <div class="row">
                        <div class="col-md-3">
                            <img class="img-responsive" src="{{ asset('userdata/' . $dish->user_id . '/dishes/' . $dish->id . '/picture_md.jpg') }}" alt="Dish Picture" width="300" height="300" />
                            <h3 class="text-center">{{ $dish->name }}</h3>
                        </div>
                        <div class="col-md-9">
                            <ul>
                                <li>{{ trans('strings.dishShowAbout2') }} {{ $dish->rating }}</li>
                                <li>{{ trans('strings.dishShowAbout3') }} {{ $dish->price }}</li>
                                <li>{{ trans('strings.dishShowAbout4') }}</li>
                                <li>{{ trans('strings.dishShowAbout5') }} {{ $dish->user->name }}</li>
                                <li>{{ trans('strings.dishShowAbout6') }} {{ $dish->description }}</li>
                                <li>{{ trans('strings.dishShowAbout7') }}
                                    @unless ($dish->tags->isEmpty())
                                        <ul>
                                            @foreach ($dish->tags as $tag)
                                                <li>{{ $tag->name }}</li>
                                            @endforeach
                                        </ul>
                                    @endunless
                                </li>
                            </ul>
                            @if ($dish->isMyDish())
                                <a href="{{ action('DishesController@edit', array('dishes' => $dish)) }}" class="btn btn-primary">{{ trans('strings.dishShowAbout8') }}</a>
                            @else
                                @if (Cart::search(array('id' => $dish->id)))
                                    <div id="dishAlreadyInCart" class="row">
                                        <strong>{{ trans('strings.dishShowAbout9') }}</strong>
                                        <a href="{{ action('DishesController@viewCart') }}" class="btn btn-primary">{{ trans('strings.dishShowAbout10') }}</a>
                                @else
                                    <div id="dishQuantityBlock" class="row">
                                        <div class="form-group center-block" style="display: flex; align-items: center;">
                                            {!! Form::open(['action' => array('DishesController@addToCart', 'dishes' => $dish)]) !!}
                                                <input type="hidden" name="dishId" value="{{ $dish->id }}">
                                                <input type="hidden" name="dishName" value="{{ $dish->name }}">
                                                <div class="col-md-3">
                                                    {!! Form::label('quantity', trans('strings.dishShowAbout11')) !!}
                                                    {!! Form::number('quantity', 1, ['id' => 'quantity', 'class' => 'form-control', 'min' => 1, 'onchange' => 'updateTotalPrice(this.value);']) !!}
                                                </div>
                                                <div class="col-md-6">
                                                    <span>{{ trans('strings.dishShowAbout12') }} <strong id="totalPrice"></strong></span>
                                                </div>
                                                <div class="col-md-6">
                                                    {!! Form::submit(trans('strings.dishShowAbout13'), ['class' => 'btn btn-primary form control']) !!}
                                                </div>
                                            {!! Form::close() !!}
                                        </div>
                                    </div>
                                    <a id="addToCartButton" class="btn btn-primary">{{ trans('strings.dishShowAbout14') }}</a>
                                @endif
                            @endif
                        </div>
                    </div>
               

                <div class="divider styleColor"><!-- divider -->
                    <i class="fa fa-chevron-down"></i>
                </div>

                <div class="row white-row">
                    <div class="col-md-12">
                        <h2>{{ trans('strings.dishShowReviews1') }}</h2>
                        <p>
                            @if ($dish->isMyDish())
                                {!! Lang::get('strings.dishShowReviews2', ['dishName' => $dish->name]) !!}
                            @else
                                {!! Lang::get('strings.dishShowReviews3', ['userName' => $dish->user->name, 'dishName' => $dish->name]) !!}
                            @endif
                        </p>
                        
                    </div>
                </div>
            </section>

        </div>
    </div>
    <!-- /WRAPPER -->

    @include('partials._footer')

@endsection

@section('afterScripts')
    <script>

        $('#dishQuantityBlock').hide();
        $('#addToCartButton').click(function() {
            $(this).hide();
            $('#dishQuantityBlock').show(400);
        });

        var price = {{ $dish->price }};
        $('#totalPrice').html($('#quantity').val() * price);

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