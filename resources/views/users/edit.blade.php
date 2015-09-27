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
        $('#profileEdit').hide();
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
        });

        var pictureRatio = 0;

        function readURL(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();

                reader.onload = function (e) {
                    $('#pictureViewer')
                            .attr('src', e.target.result);
                            //.width(150)
                            //.height(200);
                    $('#pictureViewer').one('load', function() {
                        pictureRatio = document.getElementById('pictureViewer').naturalWidth / document.getElementById('pictureViewer').clientWidth;
                        if (document.getElementById('pictureViewer').naturalWidth < 500 || document.getElementById('pictureViewer').naturalHeight < 500) {
                            $('#pictureViewer')
                                    .attr('src', '');

                            if (typeof JcropAPI != 'undefined')
                                JcropAPI.destroy();

                            initJcrop(pictureRatio);

                            alert('Picture must be at least 500x500 pixels!');

                        } else {

                            if (typeof JcropAPI != 'undefined')
                                JcropAPI.destroy();
                            initJcrop(pictureRatio);

                        }
                    });
                };

                reader.readAsDataURL(input.files[0]);
            }
        }


        function initJcrop(pictureRatio)
                {

                    $('#pictureViewer').Jcrop({
                        setSelect: [0, 0, Math.round(500 / pictureRatio), Math.round(500 / pictureRatio)],
                        aspectRatio: 1,
                        minSize: [Math.round(500 / pictureRatio), Math.round(500 / pictureRatio)],
                        allowSelect: false,
                        boxWidth: 500,//document.getElementById('pictureViewer').clientWidth,
                        boxHeight: 500//document.getElementById('pictureViewer').clientHeight
                    },function(){

                        JcropAPI = this;
                        JcropAPI.animateTo([100,100,400,300]);

                    });

                    $('#prout').mouseout(function() {
                        $('#cropx').val(Math.round(parseInt($('#pictureViewer').next().css('left')) * pictureRatio));
                        $('#cropy').val(Math.round(parseInt($('#pictureViewer').next().css('top')) * pictureRatio));
                        $('#cropw').val(Math.round(parseInt($('#pictureViewer').next().css('width')) * pictureRatio));
                        $('#croph').val(Math.round(parseInt($('#pictureViewer').next().css('height')) * pictureRatio));
                    });

                };

                $('input,text').keypress(function(event) { return event.keyCode != 13; });
                $('input,email').keypress(function(event) { return event.keyCode != 13; });

        function initialize() {

            var placeId = '{{ $user->place_id }}';
            var geocoder = new google.maps.Geocoder();
            
  geocoder.geocode({'placeId': placeId}, function(results, status) {
    if (status == google.maps.GeocoderStatus.OK) {
      if (results[0]) {
        $('#locationListElement').html('Location: ' + results[0].formatted_address);
        $('#pac-input').val(results[0].formatted_address);
      }
    }
  });
  var mapOptions = {
    center: new google.maps.LatLng(-33.8688, 151.2195),
    zoom: 13,
  };
  var map = new google.maps.Map(document.getElementById('map-canvas'),
    mapOptions);

  var input = /** @type {HTMLInputElement} */(
      document.getElementById('pac-input'));

  //var types = document.getElementById('type-selector');
  //map.controls[google.maps.ControlPosition.TOP_LEFT].push(input);
  //map.controls[google.maps.ControlPosition.TOP_LEFT].push(types);

  var autocomplete = new google.maps.places.Autocomplete(input,
    {
        types: ['(cities)']
    });
  autocomplete.bindTo('bounds', map);

  var infowindow = new google.maps.InfoWindow();
  var marker = new google.maps.Marker({
    map: map,
    anchorPoint: new google.maps.Point(0, -29)
  });

  google.maps.event.addListener(autocomplete, 'place_changed', function() {
    infowindow.close();
    marker.setVisible(false);
    var place = autocomplete.getPlace();
    if (!place.geometry) {
      window.alert("Autocomplete's returned place contains no geometry");
      return;
    }

    // If the place has a geometry, then present it on a map.
    if (place.geometry.viewport) {
      map.fitBounds(place.geometry.viewport);
    } else {
      map.setCenter(place.geometry.location);
      map.setZoom(17);  // Why 17? Because it looks good.
    }
    marker.setIcon(/** @type {google.maps.Icon} */({
      url: place.icon,
      size: new google.maps.Size(71, 71),
      origin: new google.maps.Point(0, 0),
      anchor: new google.maps.Point(17, 34),
      scaledSize: new google.maps.Size(35, 35)
    }));
    marker.setPosition(place.geometry.location);
    marker.setVisible(true);

    var address = '';
    if (place.address_components) {
      address = [
        (place.address_components[0] && place.address_components[0].short_name || ''),
        (place.address_components[1] && place.address_components[1].short_name || ''),
        (place.address_components[2] && place.address_components[2].short_name || '')
      ].join(' ');
    }

    $('#placeId').val(place.place_id);

    infowindow.setContent('<div><strong>' + place.name + '</strong><br>' + address);
    infowindow.open(map, marker);
  });

  // Sets a listener on a radio button to change the filter type on Places
  // Autocomplete.
  /*function setupClickListener(id, types) {
    var radioButton = document.getElementById(id);
    google.maps.event.addDomListener(radioButton, 'click', function() {
      autocomplete.setTypes(types);
    });
  }

  setupClickListener('changetype-all', []);
  setupClickListener('changetype-address', ['address']);
  setupClickListener('changetype-establishment', ['establishment']);
  setupClickListener('changetype-geocode', ['geocode']);*/
}

google.maps.event.addDomListener(window, 'load', initialize);
    </script>
@endsection