@extends('app')

@section('content')

    <!-- WRAPPER -->
    <div id="wrapper">

        <div id="shop">

            <!-- PAGE TITLE -->
            <header id="page-title">
                <div class="container">
                    <h1>{{ trans('strings.breadMyAccount') }}</h1>

                    <ul class="breadcrumb">
                        <li><a href="{{ action('HomeController@index') }}">{{ trans('strings.breadHome') }}</a></li>
                        <li class="active">{{ trans('strings.breadMyAccount') }}</li>
                    </ul>
                </div>
            </header>


            <section class="container">

                @include('partials._flash')

                @include('users._profile')

                <div class="divider styleColor"><!-- divider -->
                    <i class="fa fa-chevron-down"></i>
                </div>

                <div class="tabs nomargin-top">

                    <!-- tabs -->
                    <ul class="nav nav-tabs">
                        @if ($user->isChef())
                            <li class="active">
                                <a href="#tab1" data-toggle="tab">
                                    <i class="fa fa-cogs"></i> {{ trans('strings.profileChef1') }}
                                </a>
                            </li>
                            <li>
                                <a href="#tab2" data-toggle="tab">
                                    <i class="fa fa-heart"></i> {{ trans('strings.profileHungry1') }}
                                </a>
                            </li>
                        @else
                            <li class="active">
                                <a href="#tab1" data-toggle="tab">
                                    <i class="fa fa-heart"></i> {{ trans('strings.profileHungry1') }}
                                </a>
                            </li>
                            <li>
                                <a href="#tab2" data-toggle="tab">
                                    <i class="fa fa-cogs"></i> {{ trans('strings.profileChef1') }}
                                </a>
                            </li>
                        @endif
                    </ul>

                    <!-- tabs content -->
                    <div class="tab-content">
                        @if ($user->isChef())
                            <div id="tab1" class="tab-pane active">
                                @include('users._chef')
                            </div>

                            <div id="tab2" class="tab-pane">
                                @if ($user->isHungry())
                                    @include('users._hungry')
                                @else
                                    <span>{{ trans('strings.profileHungry2') }}</span>
                                @endif
                            </div>
                        @else
                            <div id="tab1" class="tab-pane active">
                                @if ($user->isHungry())
                                    @include('users._hungry')
                                @else
                                    <span>{{ trans('strings.profileHungry2') }}</span>
                                @endif
                            </div>

                            <div id="tab2" class="tab-pane">
                                    <span>
                                        {!! trans('strings.profileChef2') !!}
                                        <a href="{{ action('DishesController@create') }}" class='btn btn-primary'>{{ trans('strings.profileChef3') }}</a>
                                    </span>
                            </div>
                        @endif
                    </div>

                </div>

            </section>
        </div>
    </div>
    <!-- /WRAPPER -->

    @include('partials._footer')

    @include('reviews.create')

@endsection

@section('afterScripts')
    <script>
        $('#editProfileButton').click(function() {
            $(this).hide();
            $('#profileShow').hide(400);
            $('#profileEdit').show(400);
            $('#cancelEditProfileButton').show();
        });
        $('#cancelEditProfileButton').click(function() {
            $(this).hide();
            $('#profileEdit').hide(400);
            $('#profileShow').show(400);
            $('#editProfileButton').show();
            $('#cropped').val('false');
            if (typeof JcropAPI != 'undefined')
                JcropAPI.destroy();
            $('#JcropPicture').replaceWith("<img id='JcropPicture' class='img-responsive' src='{{ asset($profilePicturePath) }}'' alt=''/>");
        });

        $('input,text').keypress(function(event) { return event.keyCode != 13; });
        $('input,email').keypress(function(event) { return event.keyCode != 13; });

        function initializeAutocomplete() {

            var placeId = '{{ $user->address_google_place_id }}';
            var geocoder = new google.maps.Geocoder();

            geocoder.geocode({'placeId': placeId}, function(results, status) {
                if (status == google.maps.GeocoderStatus.OK) {
                    if (results[0]) {
                        var _html = $('#locationListElement').html();
                        $('#locationListElement').html(_html + ' ' + results[0].formatted_address);
                        $('#pac-input').val(results[0].formatted_address);
                    }
                }
            });

            var input = document.getElementById('pac-input');

            var autocomplete = new google.maps.places.Autocomplete(input,
            {
                types: ['(cities)']
            });

            var autocompleteService = new google.maps.places.AutocompleteService();

            var linkToFirstPrediction = function(predictions) {

                if (predictions) {
                    $('#googlePlaceId').val(predictions[0].place_id);
                }

            }

            google.maps.event.addListener(autocomplete, 'place_changed', function() {

                var place = autocomplete.getPlace();

                if (place.geometry) {
                    $('#address_google_place_id').val(place.place_id);
                    $('#lat').val(place.geometry.location.lat());
                    $('#lng').val(place.geometry.location.lng());
                } else {
                    if ($('#pac-input').val())
                        autocompleteService.getQueryPredictions({input: input.value}, linkToFirstPrediction);
                }

                var address = '';
                if (place.address_components) {
                  address = [
                    (place.address_components[0] && place.address_components[0].short_name || ''),
                    (place.address_components[1] && place.address_components[1].short_name || ''),
                    (place.address_components[2] && place.address_components[2].short_name || '')
                  ].join(' ');
                }

                $('#address_google_place_id').val(place.place_id);

            });

            $('#pac-input').mouseleave(function() {

                if ($('#pac-input').val())
                    autocompleteService.getQueryPredictions({input: input.value}, linkToFirstPrediction);

            });

            $('#pac-input').keypress(function(e) {

                if (e.keyCode == 13) {
                    e.preventDefault();
                    if ($('#pac-input').val())
                        autocompleteService.getQueryPredictions({input: input.value}, linkToFirstPrediction);
                }

            });

        }

        google.maps.event.addDomListener(window, 'load', initializeAutocomplete);
        
        var userId = '{{ Auth::user()->id }}';

    </script>

    <script type="text/javascript" src="{{ asset('js/crop-script.js') }}"></script>

@endsection