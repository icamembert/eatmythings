@include('partials._login-modal')

<!-- Top Bar -->
<header id="topHead">
    <div class="container">

        <!-- LANGUAGE -->
        <div class="btn-group pull-right hidden-xs">
            <button class="dropdown-toggle language" type="button" data-toggle="dropdown">
                <img src="{{ asset('img/flags/' . LaravelLocalization::getCurrentLocale() . '.png') }}" width="16" height="11" alt="{{ LaravelLocalization::getCurrentLocale() }} Language" /> {{ LaravelLocalization::getCurrentLocaleName() }} <span class="caret"></span>
            </button>

            <ul class="dropdown-menu">
                @foreach(LaravelLocalization::getSupportedLocales() as $localeCode => $properties)
                    <li>
                        <a rel="alternate" hreflang="{{$localeCode}}" href="{{LaravelLocalization::getLocalizedURL($localeCode) }}">
                            <img src="{{ asset('img/flags/' . $localeCode . '.png') }}" width="16" height="11" alt="{{$localeCode}} Language" /> [{{$localeCode}}] {{{ $properties['native'] }}}
                        </a>
                    </li>
                @endforeach
            </ul>
        </div>
        <!-- /LANGUAGE -->

        @if(Auth::guest())
            <!-- SIGN IN -->
            <div class="pull-right nav signin-dd">
                <a id="quick_sign_in" href="{{ action('Auth\AuthController@getLogin') }}"><i class="fa fa-users"></i><span class="hidden-xs"> {{ trans('strings.navSignIn') }}</span></a>
                <div class="dropdown-menu" role="menu" aria-labelledby="quick_sign_in">

                    <h4>Sign In</h4>
                    <form action="" method="post" role="form">

                        <div class="form-group"><!-- email -->
                            <input required type="email" class="form-control" placeholder="Username or email">
                        </div>

                        <div class="input-group">

                            <!-- password -->
                            <input required type="password" class="form-control" placeholder="Password">

                            <!-- submit button -->
                                    <span class="input-group-btn">
                                        <button class="btn btn-primary">Sign In</button>
                                    </span>

                        </div>

                        <div class="checkbox"><!-- remmember -->
                            <label>
                                <input type="checkbox"> Remember me &bull; <a href="">Forgot password?</a>
                            </label>
                        </div>

                    </form>

                    <hr />

                    <a href="#" class="btn-facebook fullwidth radius3"><i class="fa fa-facebook"></i> Connect With Facebook</a>
                    <a href="#" class="btn-twitter fullwidth radius3"><i class="fa fa-twitter"></i> Connect With Twitter</a>
                    <!--<a href="#" class="btn-google-plus fullwidth radius3"><i class="fa fa-google-plus"></i> Connect With Google</a>-->

                    <p class="bottom-create-account">
                        <a href="{{ action('Auth\AuthController@getRegister') }}">Manual create account</a>
                    </p>
                </div>
            </div>
            <!-- /SIGN IN -->
        @else
            <a href="{{ action('UsersController@edit') }}"><i class="fa fa-users"></i><span class="hidden-xs">{{ Auth::user()->name}}</span></a>
            <a href="{{ action('Auth\AuthController@getLogout') }}"><i class="fa fa-sign-out"></i><span class="hidden-xs">{{ trans('strings.navSignOut') }}</span></a>
        @endif

        <!-- CART MOBILE BUTTON -->
        <a class="pull-right" id="btn-mobile-quick-cart" href="shop-cart.html"><i class="fa fa-shopping-cart"></i></a>
        <!-- CART MOBILE BUTTON -->

        <!-- LINKS -->
        <div class="pull-right nav hidden-xs">
            <a href="page-about-us.html"><i class="fa fa-angle-right"></i> {{ trans('strings.navAbout') }}</a>
            <a href="contact-us.html"><i class="fa fa-angle-right"></i> {{ trans('strings.navContact') }}</a>
        </div>
        <!-- /LINKS -->

    </div>
</header>
<!-- /Top Bar -->

<!-- TOP NAV -->
<header id="topNav" class="topHead"><!-- remove class="topHead" if no topHead used! -->
    <div class="container">

        <!-- Mobile Menu Button -->
        <button class="btn btn-mobile" data-toggle="collapse" data-target=".nav-main-collapse">
            <i class="fa fa-bars"></i>
        </button>

        <!-- Logo text or image -->
        <a class="logo" href="{{ action('HomeController@index') }}">
            <img src="{{ asset('img/logo-alone-very-small.png') }}" alt="Eat My Things" />
        </a>

        <!-- Top Nav -->
        <div class="navbar-collapse nav-main-collapse collapse pull-right">
            <nav class="nav-main mega-menu">
                <ul class="nav nav-pills nav-main scroll-menu" id="topMain">                    
                    
                    <li class="dropdown">
                        <a class="dropdown-toggle" href="{{ action('HomeController@index') }}">
                            <b>{{ trans('strings.navMenuTitle') }}</b> <i class="fa fa-angle-down"></i>
                        </a>
                        <ul class="dropdown-menu">
                            <li><a href="magazine-home.html">{{ trans('strings.navMenuItem1') }}</a></li>
                            <li><a href="magazine-category.html">{{ trans('strings.navMenuItem2') }}</a></li>
                            <li><a href="magazine-single.html">{{ trans('strings.navAbout') }}</a></li>
                            <li class="divider"></li>
                            <li><a href="realestate-home.html">{{ trans('strings.navContact') }}</a></li>
                        </ul>
                    </li>

                    <!-- GLOBAL SEARCH -->
                    <li class="search">
                        <!-- search form -->
                        <form method="get" action="#" class="input-group pull-right">
                            <input type="text" class="form-control" name="k" id="k" value="" placeholder="{{ trans('strings.navSearch') }}">
									<span class="input-group-btn">
										<button class="btn btn-primary notransition"><i class="fa fa-search"></i></button>
									</span>
                        </form>
                        <!-- /search form -->
                    </li>
                    <!-- /GLOBAL SEARCH -->

                    <!-- QUICK SHOP CART -->
                    <li class="quick-cart">
                        <span class="badge pull-right">{{ Cart::count() }}</span>

                        <div class="quick-cart-content">

                            @if (Cart::count())
                                <p><i class="fa fa-warning"></i> {{ trans('strings.navCartNotEmpty') }}</p>
                                
                                @foreach (Cart::content() as $item)
                                    <a class="item" href="{{ action('DishesController@show', array('dishes' => $item->options->dish, 'isBeingOrdered' => 0)) }}">
                                        <img class="pull-left" src="{{ asset('/userdata/' . $item->options->chefId . '/dishes/' . $item->id . '/picture_sm.jpg') }}" width="40" alt="Dish Picture" />
                                        <div class="inline-block">
                                            <span class="title">{{ $item->name }}</span>
                                            <span class="price">{{ $item->qty }} &times; {{ $item->price }} </span>
                                        </div>
                                    </a>
                                @endforeach

                                <!-- QUICK CART BUTTONS -->
                                <div class="row cart-footer">
                                    <img class="img-responsive" src="{{ asset('img/leo-pushing-cart.png') }}" alt="Eat My Things" />
                                    <div class="col-md-6 nopadding-right">
                                        <a href="{{ action('DishesController@viewCart') }}" class="btn btn-primary btn-xs fullwidth">{{ trans('strings.navCartButton1') }}</a>
                                    </div>
                                    <div class="col-md-6 nopadding-left">
                                        <a href="{{ action('OrdersController@create') }}" class="btn btn-info btn-xs fullwidth">{{ trans('strings.navCartButton2') }}</a>
                                    </div>
                                </div>
                                <!-- /QUICK CART BUTTONS -->
                            @else
                                <p><i class="fa fa-warning"></i> {{ trans('strings.navCartEmpty') }}</p>
                            @endif

                        </div>

                    </li>
                    <!-- /QUICK SHOP CART -->

                </ul>
            </nav>
        </div>
        <!-- /Top Nav -->

    </div>

</header>

<span id="header_shadow"></span>
<!-- /TOP NAV -->