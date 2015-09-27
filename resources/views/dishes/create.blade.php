@extends('app')

@section('content')


    <!-- WRAPPER -->
    <div id="wrapper">

        <div id="shop">

            <!-- PAGE TITLE -->
            <header id="page-title">
                <div class="container">
                    <h1>{{ trans('strings.breadAddDish') }}</h1>

                    <ul class="breadcrumb">
                        <li><a href="{{ action('HomeController@index') }}">{{ trans('strings.breadHome') }}</a></li>
                        <li class="active">{{ trans('strings.breadAddDish') }}</li>
                    </ul>
                </div>
            </header>


            <section class="container white-row">

                <div class="row">

                    <!-- CREATE DISH -->
                    <div class="col-md-6">

                        <h2>{{ trans('strings.dishCreate1') }}</h2>

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

                        {!! Form::open(['url' => 'dishes', 'role' => 'form', 'files' => true]) !!}
                        @include('dishes._form', ['submitButtonText' => trans('strings.dishCreate7')])
                        {!! Form::close() !!}

                        @include('errors.list')

                    </div>
                    <!-- /CREATE DISH -->

                </div>

                <div id="prout" class="row" style="padding-top: 15px;">
                    <div class="col-md-6">
                        <img id="pictureViewer" class="img-responsive" src="" alt="" width="500px" height="500px"/>
                    </div>
                </div>

            </section>

        </div>
    </div>
    <!-- /WRAPPER -->

    @include('partials._footer')

@endsection
