@extends('app')

@section('content')

    <!-- WRAPPER -->
    <div id="wrapper">

        <div id="shop">

            <!-- PAGE TITLE -->
            <header id="page-title">
                <div class="container">
                    <h1>{{ trans('strings.breadSignIn') }}</h1>

                    <ul class="breadcrumb">
                        <li><a href="{{ action('HomeController@index') }}">{{ trans('strings.breadHome') }}</a></li>
                        <li class="active">{{ trans('strings.breadSignIn') }}</li>
                    </ul>
                </div>
            </header>


            <section class="container">

                <div class="row">

                    <!-- LOGIN -->
                    <div class="col-md-6">

                        <h2>{!! trans('strings.signInLogin1') !!}</h2>

                        @if (count($errors) > 0)
                            <div class="alert alert-danger">
                                <strong>Whoops!</strong> There were some problems with your input.<br><br>
                                <!--<ul>
                                    //@foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    //@endforeach
                                </ul>-->
                            </div>
                        @endif

                        <form class="white-row" role="form" method="POST" action="{{ action('Auth\AuthController@getLogin') }}">
                            <input type="hidden" name="_token" value="{{ csrf_token() }}">

                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>{{ trans('strings.signInLogin2') }}</label>
                                        <input type="email" class="form-control" name="email" value="{{ old('email') }}">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>{{ trans('strings.signInLogin3') }}</label>
                                        <input type="password" class="form-control" name="password">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
										<span class="remember-box checkbox">
											<label for="rememberme">
                                                <input type="checkbox" id="rememberme" name="remember">{{ trans('strings.signInLogin4') }}
                                            </label>
										</span>
                                </div>
                                <div class="col-md-6">
                                    <input type="submit" value="{{ trans('strings.signInLogin5') }}" class="btn btn-primary pull-right" data-loading-text="Loading...">
                                </div>
                            </div>

                        </form>

                    </div>
                    <!-- /LOGIN -->

                    <!-- PASSWORD -->
                    <div class="col-md-6">

                        <h2>{!! trans('strings.signInForgot1') !!}</h2>

                        <div class="white-row">

                            <p>
                                {{ trans('strings.signInForgot2') }}
                            </p>

                            <!-- alert success -->
                            <div class="alert alert-success">
                                <i class="fa fa-check-circle"></i>
                                <strong>New Password Sent!</strong> Check your E-mail Address!
                            </div>

                            <!-- alert failed -->
                            <div class="alert alert-danger">
                                <i class="fa fa-frown-o"></i>
                                <strong>E-mail Address</strong> not found!
                            </div>

                            <!-- password form -->
                            <label>{!! trans('strings.signInForgot3') !!}</label>
                            <form class="input-group" method="post" action="#">
                                <input type="text" class="form-control" name="s" id="s" value="" placeholder="{{ trans('strings.signInForgot4') }}" />
									<span class="input-group-btn">
										<button class="btn btn-primary">{{ trans('strings.signInForgot5') }}</button>
									</span>
                            </form>

                        </div>

                    </div>
                    <!-- /PASSWORD -->

                </div>


                <p class="white-row">
                    {{ trans('strings.signInNoAccountYet1') }}
                    <a href="{{ action('Auth\AuthController@getRegister') }}">{{ trans('strings.signInNoAccountYet1') }}</a>
                    {{ trans('strings.signInNoAccountYet3') }}
                </p>

            </section>

        </div>
    </div>
    <!-- /WRAPPER -->

    @include('partials._footer')

@endsection
