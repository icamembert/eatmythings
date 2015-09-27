@extends('app')

@section('content')

    <!-- WRAPPER -->
    <div id="wrapper">

        <div id="shop">

            <!-- PAGE TITLE -->
            <header id="page-title">
                <div class="container">
                    <h1>{{ trans('strings.breadSignUp') }}</h1>

                    <ul class="breadcrumb">
                        <li><a href="{{ action('HomeController@index') }}">{{ trans('strings.breadHome') }}</a></li>
                        <li class="active">{{ trans('strings.breadSignUp') }}</li>
                    </ul>
                </div>
            </header>


            <section class="container">

                <div class="row">

                    <!-- REGISTER -->
                    <div class="col-md-6">

                        <h2>{!! trans('strings.signUpRegister1') !!}</h2>

                        <form class="white-row" role="form" method="POST" action="{{ action('Auth\AuthController@getRegister') }}">
                            <input type="hidden" name="_token" value="{{ csrf_token() }}">

                            @if (count($errors) > 0)
                                <!-- alert failed -->
                                <div class="alert alert-danger">
                                    <i class="fa fa-frown-o"></i>
                                    <ul>
                                        @foreach ($errors->all() as $error)
                                            <li><strong>{{ $error }}</strong></li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endif

                            <div class="row">
                                <div class="form-group">
                                    <div class="col-md-12">
                                        <label>{{ trans('strings.signUpRegister2') }}</label>
                                        <input type="text" class="form-control" name="name" value="{{ old('name') }}">
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="form-group">
                                    <div class="col-md-12">
                                        <label>{{ trans('strings.signUpRegister3') }}</label>
                                        <input type="email" class="form-control" name="email" value="{{ old('email') }}">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group">
                                    <div class="col-md-6">
                                        <label>{{ trans('strings.signUpRegister4') }}</label>
                                        <input type="password" class="form-control" name="password">
                                    </div>
                                    <div class="col-md-6">
                                        <label>{{ trans('strings.signUpRegister5') }}</label>
                                        <input type="password" class="form-control" name="password_confirmation">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <input type="submit" value="{{ trans('strings.signUpRegister6') }}" class="btn btn-primary pull-right push-bottom" data-loading-text="Loading...">
                                </div>
                            </div>

                        </form>

                    </div>
                    <!-- /REGISTER -->

                    <!-- WHY? -->
                    <div class="col-md-6">

                        <h2>{{ trans('strings.signUpWhy1') }}</h2>

                        <div class="white-row">

                            <h4>{!! trans('strings.signUpWhy2') !!}</h4>

                            <p>{{ trans('strings.signUpWhy3') }}</p>
                            <ul class="list-icon check">
                                <li>{{ trans('strings.signUpWhy4') }}</li>
                                <li>{{ trans('strings.signUpWhy5') }}</li>
                                <li>{{ trans('strings.signUpWhy6') }}</li>
                                <li>{{ trans('strings.signUpWhy7') }}</li>
                                <li>{{ trans('strings.signUpWhy8') }}</li>
                            </ul>

                            <hr class="half-margins" />

                            <p>
                                {{ trans('strings.signUpAlreadyAccount1') }}
                                <a href="{{ action('Auth\AuthController@getLogin') }}">{{ trans('strings.signUpAlreadyAccount2') }}</a>
                            </p>
                        </div>

                        <div class="white-row">
                            <h4>{!! trans('strings.signUpContact1') !!}</h4>
                            <p>
                                {{ trans('strings.signUpContact2') }}
                                {{ trans('strings.signUpContact3') }}
                            </p>
                        </div>

                    </div>
                    <!-- /WHY? -->

                </div>

            </section>

        </div>
    </div>
    <!-- /WRAPPER -->

    @include('partials._footer')

@endsection
