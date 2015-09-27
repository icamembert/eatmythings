@if ($user->isMe())
    <div class="row">
        <div class="col-md-12">
            <h2>{{ trans('strings.profileChefOrders1') }}</h2>
            <form class="white-row" method="post" action="shop-cc-pay.html">
                <p>
                    {{ trans('strings.profileChefOrders3') }}
                </p>
                <h5>{{ trans('strings.profileChefOrders4') }}</h5>
                
                <!-- LIST OF ORDERS FROM OTHER USERS -->
                <div class="row">
                    <div class="form-group">
                        <div class="col-md-12">
                            <table class="table table-hover table-bordered" style="table-layout: fixed">
                                <thead>
                                <tr>
                                    <th class="text-center" style="width: 5%;">#</th>
                                    <th class="text-center" style="width: 40%;">{{ trans('strings.profileChefOrders5') }}</th>
                                    <th class="text-center" style="width: 10%;">{{ trans('strings.profileChefOrders6') }}</th>
                                    <th class="text-center" style="width: 10%;">{{ trans('strings.profileChefOrders7') }}</th>
                                    <th class="text-center" style="width: 15%;">{{ trans('strings.profileChefOrders8') }}</th>
                                    <th class="text-center" style="width: 20%;">{{ trans('strings.profileChefOrders9') }}</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach ($clientOrders as $index => $clientOrder)
                                    <tr>
                                        <th class="text-center" style="vertical-align: middle;" scope="row">{{ $index + 1 }}</th>
                                        <td class="text-center" style="vertical-align: middle;">
                                            <ul>
                                                @foreach ($clientOrder->dishes as $orderedDish)
                                                    <li>{{ $orderedDish->name }}: {{ $orderedDish->quantity }}</li>
                                                @endforeach
                                            </ul>
                                        </td>
                                        <td class="text-center" style="vertical-align: middle;">{{ $clientOrder->user->toArray()['name'] }}</td>
                                        <td class="text-center" style="vertical-align: middle;">{{ $clientOrder->price }}</td>
                                        <td style="vertical-align: middle;">{{ $clientOrder->served_at }}</td>
                                        <td class="text-center" style="vertical-align: middle;">
                                            @if ($clientOrder->status_id == 0)
                                                <span class="orange"><strong>{{ trans('strings.profileChefOrders10') }}</strong></span>
                                                <a href="{{ action('OrdersController@accept', array('orders' => $clientOrder)) }}"><i class="fa fa-check" title="{{ trans('strings.profileChefOrders11') }}"></i></a>
                                                <a href="{{ action('OrdersController@reject', array('orders' => $clientOrder)) }}"><i class="fa fa-times" title="{{ trans('strings.profileChefOrders12') }}"></i></a>
                                            @elseif ($clientOrder->status_id == 1)
                                                <span class="green"><strong>{{ trans('strings.profileChefOrders13') }}</strong></span>
                                            @elseif ($clientOrder->status_id == 2)
                                                <span class="red"><strong>{{ trans('strings.profileChefOrders14') }}</strong></span>
                                            @elseif ($clientOrder->status_id ==3)
                                                <span class="blue"><strong>{{ trans('strings.profileChefOrders15') }}</strong></span>
                                            @endif
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <!-- /LIST OF ORDERS FROM OTHER USERS -->
            </form>
        </div>
    </div>

    <div class="divider styleColor"><!-- divider -->
        <i class="bg-white fa fa-star"></i>
    </div>
@endif

<div class="row">
    <div class="col-md-12">
        @if ($user->isMe())
            <h2>{{ trans('strings.profileChefDishes1') }}</h2>
        @else
            <h2>{{ Lang::get('strings.profileChefDishes2', ['userName' => $user->name]) }}</h2>
        @endif
        <form class="white-row" method="post" action="shop-cc-pay.html">
            <p>
                @if ($user->isMe())
                    {{ trans('strings.profileChefDishes3') }}
                @else
                    {{ trans('strings.profileChefDishes4') }}
                @endif
            </p>
            @if ($user->isMe())
                <p>
                    <strong>{{ trans('strings.profileChefDishes5') }}</strong>
                    <a href="{{ action('DishesController@create') }}" class="btn btn-primary">{{ trans('strings.profileChefDishes6') }}</a>
                </p>
            @else
                @unless ($user->isChef())
                <p>
                    <strong>{{ trans('strings.profileChefDishes7') }}</strong>
                    <a href="{{ action('DishesController@create') }}" class="btn btn-primary">{{ trans('strings.profileChefDishes8') }}</a>
                </p>
                @endunless
            @endif
            <h5>Dishes:</h5>

            <!-- LIST OF DISHES -->
            <div class="row">
                <div class="form-group">
                    <div class="col-md-12">
                        <table class="table table-hover table-bordered" style="table-layout: fixed">
                            <thead>
                            <tr>
                                <th class="text-center" style="width: 5%;">#</th>
                                <th class="text-center" style="width: 15%;">{{ trans('strings.profileChefDishes9') }}</th>
                                <th class="text-center" style="width: 5%;">{{ trans('strings.profileChefDishes10') }}</th>
                                <th class="text-center" style="width: 10%;">{{ trans('strings.profileChefDishes11') }}</th>
                                <th class="text-center" style="width: 33%;">{{ trans('strings.profileChefDishes12') }}</th>
                                <th class="text-center" style="width: 7%;">{{ trans('strings.profileChefDishes13') }}</th>
                                <th class="text-center" style="width: 10%;">{{ trans('strings.profileChefDishes14') }}</th>
                                <th class="text-center" style="width: 20%;">{{ trans('strings.profileChefDishes15') }}</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach ($user->dishes as $index => $dish)
                                <tr>
                                    @if ($user->isMe())
                                        <th class="text-center" style="vertical-align: middle;" scope="row">{{ $index + 1 }}</th>
                                        <td><a href="{{ action('DishesController@show', array('dishes' => $dish, 'isBeingOrdered' => 0)) }}"><img class="img-responsive center-block" src="{{ asset('/userdata/' . $user->id . '/dishes/' . $dish->id . '/picture_sm.jpg') }}" alt="Dish Picture" width="130" height="130" /></a></td>
                                        <td class="text-center" style="vertical-align: middle;">{{ $dish->currency }} {{ $dish->price }}</td>
                                        <td class="text-center" style="vertical-align: middle;">{{ $dish->name }}</td>
                                        <td><div class="ellipsis" style="height: 100px;">{{ $dish->description }}</div></td>
                                        <td class="text-center" style="vertical-align: middle;">{{ $dish->rating }}%</td>
                                        <td class="text-center" style="vertical-align: middle;">{{ $dish->created_at }}</td>
                                        <td class="text-center" style="vertical-align: middle;">
                                            <a href="{{ action('DishesController@edit', array('dishes' => $dish)) }}" class="btn btn-primary">{{ trans('strings.profileChefDishes16') }}</a>
                                            <a href="" class="btn btn-primary">{{ trans('strings.profileChefDishes17') }}</a>
                                        </td>
                                    @else
                                        <th class="text-center" style="vertical-align: middle;" scope="row">{{ $index + 1 }}</th>
                                        <td><a href="{{ action('DishesController@show', array('dishes' => $dish, 'isBeingOrdered' => 0)) }}"><img class="img-responsive center-block" src="{{ asset('/userdata/' . $user->id . '/dishes/' . $dish->id . '/picture_sm.jpg') }}" alt="Dish Picture" width="130" height="130" /></a></td>
                                        <td class="text-center" style="vertical-align: middle;">{{ $dish->currency }} {{ $dish->price }}</td>
                                        <td class="text-center" style="vertical-align: middle;">{{ $dish->name }}</td>
                                        <td><div class="ellipsis" style="height: 100px;">{{ $dish->description }}</div></td>
                                        <td class="text-center" style="vertical-align: middle;">{{ $dish->rating }}%</td>
                                        <td class="text-center" style="vertical-align: middle;">{{ $dish->created_at }}</td>
                                        <td class="text-center" style="vertical-align: middle;">
                                            <a href="{{ action('DishesController@show', array('dishes' => $dish, 'isBeingOrdered' => 0)) }}" class="btn btn-primary">{{ trans('strings.profileChefDishes18') }}</a>
                                            <a href="{{ action('DishesController@show', array('dishes' => $dish, 'isBeingOrdered' => 1)) }}" class="btn btn-primary">{{ trans('strings.profileChefDishes19') }}</a>
                                        </td>
                                    @endif

                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <!-- /LIST OF DISHES -->
        </form>
    </div>
</div>

<div class="divider styleColor"><!-- divider -->
    <i class="bg-white fa fa-star"></i>
</div>



<div class="row">
    <div class="col-md-12">
        <h2>{{ trans('strings.profileChefReviews1') }}</h2>
        <form class="white-row" method="post" action="shop-cc-pay.html">
            <p>
                @if ($user->isMe())
                    {{ trans('strings.profileChefReviews2') }}
                @else
                    {!! Lang::get('strings.profileChefReviews3', ['userName' => $user->name]) !!}
                @endif
            </p>

            <h5>{{ trans('strings.profileChefReviews4') }}</h5>

            <!-- LIST OF REVIEWS FROM OTHER USERS-->
            <div class="row">
                <div class="form-group">
                    <div class="col-md-12">
                        <table class="table table-hover">
                            <thead>
                            <tr>
                                <th class="text-center" style="width: 5%;">#</th>
                                <th class="text-center" style="width: 10%;">Author</th>
                                <th class="text-center" style="width: 15%;">Title</th>
                                <th class="text-center" style="width: 30%;">Body</th>
                                <th class="text-center" style="width: 10%;">Chef Rating</th>
                                <th class="text-center" style="width: 15%;">Date</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach ($user->clientReviews as $index => $clientReview)
                                <tr>
                                    <th class="text-center" style="vertical-align: middle;" scope="row">{{ $index + 1 }}</th>
                                    <td class="text-center" style="vertical-align: middle;">{{ $clientReview->user->toArray()['name'] }}</td>
                                    <td class="text-center" style="vertical-align: middle;">{{ $clientReview->title }}</td>
                                    <td><div class="ellipsis" style="height: 100px;">{{ $clientReview->body }}</div></td>
                                    <td class="text-center" style="vertical-align: middle;">{{ $clientReview->chef_rating }}%</td>
                                    <td class="text-center" style="vertical-align: middle;">{{ $clientReview->created_at }}</td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <!-- /LIST OF REVIEWS FROM OTHER USERS -->
        </form>
    </div>
</div>

<div class="divider styleColor"><!-- divider -->
    <i class="bg-white fa fa-star"></i>
</div>