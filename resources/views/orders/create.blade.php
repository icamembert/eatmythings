@extends('app')

@section('content')


    <!-- WRAPPER -->
    <div id="wrapper">

        <div id="shop">

            <!-- PAGE TITLE -->
            <header id="page-title">
                <div class="container">
                    <h1>{{ trans('strings.breadPlaceOrder') }}</h1>

                    <ul class="breadcrumb">
                        <li><a href="{{ action('HomeController@index') }}">{{ trans('strings.breadHome') }}</a></li>
                        <li class="active">{{ trans('strings.breadPlaceOrder') }}</li>
                    </ul>
                </div>
            </header>


            <section class="container white-row">

                <div class="row">

                    <!-- CREATE ORDER -->
                    <div class="col-md-6">

                        <h2>{{ trans('strings.order1') }}</h2>

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

                        {!! Form::open(['url' => 'orders']) !!}
                            @include('orders._form', ['submitButtonText' => trans('strings.order10')])
                        {!! Form::close() !!}

                        @include('errors.list')

                    </div>
                    <!-- /CREATE ORDER -->

                </div>

            </section>

        </div>
    </div>
    <!-- /WRAPPER -->

    @include('partials._footer')

@endsection

@section('afterScripts')
    <script>

        $(function () {
            $('#datetimepicker').datetimepicker({
                format: 'YYYY-MM-DD HH:mm:00'
                //daysOfWeekDisabled: [0, 6]
            });
        });

    </script>
@endsection
