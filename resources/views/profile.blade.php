@extends('app')

@section('content')

    <!-- WRAPPER -->
    <div id="wrapper">

        <div id="shop">

            <!-- PAGE TITLE -->
            <header id="page-title">
                <div class="container">
                    <h1>My Account</h1>

                    <ul class="breadcrumb">
                        <li><a href="{{ url('/') }}">Home</a></li>
                        <li class="active">My Account</li>
                    </ul>
                </div>
            </header>


            <section class="container">

                <h2>Profile</h2>
                <form class="white-row" method="post" action="#">

                    <div class="row">
                        <div class="col-md-3">
                            <img class="img-responsive" src="{{ asset('img/demo/shop/1.jpg') }}" alt="Profile Picture" width="260" height="260" />
                            <h3>{{ Auth::user()->name }}</h3>
                        </div>
                        <div class="col-md-9">
                            <ul>
                                <li>Email : {{ Auth::user()->email }}</li>
                                <li>Member since: {{ Auth::user()->created_at }}</li>
                                <li>Location: </li>
                                <li>Number of dishes: {{ Auth::user()->dishes->count() }}</li>
                                <li>About him/her: </li>
                            </ul>
                        </div>
                    </div>
                </form>

                <div class="divider styleColor"><!-- divider -->
                    <i class="fa fa-chevron-down"></i>
                </div>


                <div class="row">
                    <div class="col-md-12">

                        <h2>Orders</h2>
                        <form class="white-row" method="post" action="shop-cc-pay.html">
                            <p>
                                <strong>Returning customer?</strong> <a href="page-signin.html">Click to login</a>.
                            </p>
                            <p>
                                Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et quasi architecto beatae vitae dicta sunt.
                            </p>

                            <h5>Orders:</h5>

                            <!-- LIST OF ORDERS -->
                            <div class="row">
                                <div class="form-group">
                                    <div class="col-md-12">
                                        <table class="table table-hover">
                                            <thead>
                                                <tr>
                                                    <th>Order ID</th>
                                                    <th>Client</th>
                                                    <th>Dish</th>
                                                    <th>Type</th>
                                                    <th>Status</th>
                                                    <th>Ordered for</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach (Auth::user()->clientOrders as $clientOrder)
                                                    <tr>
                                                        <th scope="row">{{ $clientOrder->id }}</th>

                                                        <td>{{ $clientOrder->user_id }}</td>
                                                        <td>{{ $clientOrder->dish_id }}</td>
                                                        <td>{{ $clientOrder->type_id }}</td>
                                                        <td>{{ $clientOrder->status_id }}</td>
                                                        <td>{{ $clientOrder->served_at }}</td>
                                                    </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                            <!-- /LIST OF ORDERS -->
                        </form>
                    </div>
                </div>

                <div class="divider styleColor"><!-- divider -->
                    <i class="fa fa-chevron-down"></i>
                </div>


                <div class="row">
                    <div class="col-md-8">

                        <h2>Dishes</h2>
                        <form class="white-row" method="post" action="shop-cc-pay.html">
                            <p>
                                <strong>Returning customer?</strong> <a href="page-signin.html">Click to login</a>.
                            </p>
                            <p>
                                Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et quasi architecto beatae vitae dicta sunt.
                            </p>

                            <h5>Dishes:</h5>

                            <!-- LIST OF DISHES -->
                            <div class="row">
                                <div class="form-group">
                                    <div class="col-md-12">
                                        <table class="table table-hover">
                                            <thead>
                                            <tr>
                                                <th>Dish ID</th>
                                                <th>Picture</th>
                                                <th>Name</th>
                                                <th>Description</th>
                                                <th>Price</th>
                                                <th>Created on</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            @foreach (Auth::user()->dishes as $dish)
                                                <tr>
                                                    <th scope="row">{{ $dish->id }}</th>

                                                    <td></td>
                                                    <td>{{ $dish->name }}</td>
                                                    <td>{{ $dish->description }}</td>
                                                    <td>{{ $dish->price }}</td>
                                                    <td>{{ $dish->created_at }}</td>
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

                    <div class="col-md-4">

                        <h2>Discount Code</h2>
                        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Curabitur pellentesque neque eget diam porta.</p>

                        <div class="alert alert-success">
                            <i class="fa fa-check-circle"></i>
                            <strong>CODE-0017Y</strong> - 10% Discount!
                        </div>

                        <div class="alert alert-danger">
                            <i class="fa fa-frown-o"></i>
                            Sorry, Invalid Code!
                        </div>

                        <form class="input-group" method="post" action="#">
                            <input type="text" class="form-control" name="k" id="k" value="" placeholder="promo code" />
                                    <span class="input-group-btn">
                                        <button class="btn btn-primary"><i class="fa fa-check"></i></button>
                                    </span>
                        </form>

                        <div class="shop-cart-final-payment text-right">
                            <hr />
                            <span class="block fsize13">Shipping: $0</span>
                            <span class="block fsize13">Discount: $0</span>
                            <span class="fsize20 styleSecondColor bold">TOTAL: $64</span>
                        </div>

                    </div>
                </div>

            </section>

        </div>
    </div>
    <!-- /WRAPPER -->

    @include('partials._footer')

@endsection