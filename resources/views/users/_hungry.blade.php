@if ($user->isMe())
    <div class="row">
        <div class="col-md-12">
            <h2>{{ trans('strings.profileHungryOrders1') }}</h2>
            <form class="white-row" method="post" action="shop-cc-pay.html">
                <p>
                    {{ trans('strings.profileHungryOrders2') }}
                </p>
                <h5>{{ trans('strings.profileHungryOrders3') }}</h5>

                <!-- LIST OF ORDERS FROM USER -->
                <div class="row">
                    <div class="form-group">
                        <div class="col-md-12">
                            <table class="table table-hover table-bordered" style="table-layout: fixed">
                                <thead>
                                <tr>
                                    <th class="text-center" style="width: 5%;">#</th>
                                    <th class="text-center" style="width: 35%;">{{ trans('strings.profileHungryOrders4') }}</th>
                                    <th class="text-center" style="width: 15%;">{{ trans('strings.profileHungryOrders5') }}</th>
                                    <th class="text-center" style="width: 10%;">{{ trans('strings.profileHungryOrders6') }}</th>
                                    <th class="text-center" style="width: 15%;">{{ trans('strings.profileHungryOrders7') }}</th>
                                    <th class="text-center" style="width: 20%;">{{ trans('strings.profileHungryOrders8') }}</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach ($user->orders as $index => $order)
                                    @if ($order->status_id <> 3)
                                        <tr>
                                            <th class="text-center" style="vertical-align: middle;" scope="row">{{ $index + 1 }}</th>
                                            <td class="text-center" style="vertical-align: middle;">
                                                <ul>
                                                    @foreach ($order->dishes as $orderedDish)
                                                        <li><a href="{{ action('DishesController@show', array('dishes' => $orderedDish)) }}" title="{{ trans('strings.profileHungryOrders9') }}">{{ $orderedDish->name }}: {{ $orderedDish->quantity }}</a></li>
                                                    @endforeach
                                                </ul>
                                            </td>
                                            <td class="text-center" style="vertical-align: middle;"><a href="{{ action('UsersController@show', array('users' => $order->dishes->first()->user->id)) }}" title="{{ trans('strings.profileHungryOrders10') }}">{{ $order->dishes->first()->user->name }}</a></td>
                                            <td class="text-center" style="vertical-align: middle;">{{ $order->price }}</td>
                                            <td class="text-center" style="vertical-align: middle;">{{ $order->served_at }}</td>
                                            <td class="text-center" style="vertical-align: middle;">
                                                @if ($order->status_id == 0)
                                                    <span class="orange"><strong>{{ trans('strings.profileHungryOrders11') }}</strong></span>
                                                    <a href="{{ action('OrdersController@edit', array('orders' => $order)) }}"><i class="fa fa-edit" title="{{ trans('strings.profileHungryOrders12') }}"></i></a>
                                                    <a href="{{ action('OrdersController@cancel', array('orders' => $order)) }}"><i class="fa fa-times" title="{{ trans('strings.profileHungryOrders13') }}"></i></a>
                                                @elseif ($order->status_id == 1)
                                                    <span class="green"><strong>{{ trans('strings.profileHungryOrders14') }}</strong></span>
                                                    @if ($order->reviewed())
                                                        <span><a data-toggle="modal" data-target=".review-modal" onclick="Javascript: document.getElementById('orderId').value = {{ $order->id }}; document.getElementById('order' + {{ $order->id }}).style = 'visible';"><i class="fa fa-pencil" title="{{ trans('strings.profileHungryOrders15') }}"></i></a></span>
                                                    @else
                                                        
                                                    @endif
                                                @elseif ($order->status_id == 2)
                                                    <span class="red"><strong>{{ trans('strings.profileHungryOrders16') }}</strong></span>
                                                @endif
                                            </td>
                                        </tr>
                                    @endif
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <!-- /LIST OF ORDERS FROM USER -->
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
            <h2>{{ trans('strings.profileHungryReviews1') }}</h2>
        @else
            <h2>{{ Lang::get('strings.profileHungryReviews2', ['userName' => $user->name]) }}</h2>
        @endif
        <form class="white-row" method="post" action="shop-cc-pay.html">
            <p>
                @if ($user->isMe())
                    {{ trans('strings.profileHungryReviews3') }}
                @else
                    {{ Lang::get('strings.profileHungryReviews4', ['userName' => $user->name]) }}
                @endif
            </p>
            <h5>{{ trans('strings.profileHungryReviews5') }}</h5>

            <!-- LIST OF REVIEWS FROM USER -->
            <div class="row">
                <div class="form-group">
                    <div class="col-md-12">
                        <table class="table table-hover table-bordered" style="table-layout: fixed">
                            <thead>
                            <tr>
                                <th class="text-center" style="width: 5%; vertical-align: middle;">#</th>
                                <th class="text-center" style="width: 15%; vertical-align: middle;">Dish</th>
                                <th class="text-center" style="width: 10%; vertical-align: middle;">Chef's Name</th>
                                <th class="text-center" style="width: 10%; vertical-align: middle;">Title</th>
                                <th class="text-center" style="width: 35%; vertical-align: middle;">Body</th>
                                <th class="text-center" style="width: 10%; vertical-align: middle;">Chef Rating</th>
                                <th class="text-center" style="width: 15%; vertical-align: middle;">Date</th>
                            </tr>
                            </thead>
                            <tbody>
                            
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <!-- /LIST OF REVIEWS FROM USER -->
        </form>
    </div>
</div>