@extends('app')

@section('content')

    <!-- WRAPPER -->
    <div id="wrapper">

        <!-- REVOLUTION SLIDER -->
        <div class="fullwidthbanner-container roundedcorners">
            <div class="fullwidthbanner">
                <ul>

                    <!-- SLIDE  -->
                    <li data-transition="3dcurtain-vertical" ddata-slotamount="15" data-masterspeed="300" data-delay="9400">

                        <!-- COVER IMAGE -->
                        <img src="{{ asset('img/slider-bg1.jpg') }}" alt="" data-bgfit="cover" data-bgposition="left top" data-bgrepeat="no-repeat">

                        <div class="tp-caption large_bold_grey lfl stl"
                             data-x="18"
                             data-y="233"
                             data-speed="300"
                             data-start="500"
                             data-easing="easeOutExpo" data-end="8800" data-endspeed="300" data-endeasing="easeInSine">{{ trans('strings.homeCarousel1') }}
                        </div>

                        <div class="tp-caption large_bold_grey medium_thin_grey lfl stl"
                             data-x="18"
                             data-y="200"
                             data-speed="300"
                             data-start="800"
                             data-easing="easeOutExpo" data-end="9100" data-endspeed="300" data-endeasing="easeInSine">
                            <a target="_blank" href="https://wrapbootstrap.com/theme/atropos-responsive-website-template-WB05SR527">{{ trans('strings.homeCarousel2') }}</a>
                        </div>

                        <div class="tp-caption lft ltb"
                             data-x="80"
                             data-y="0"
                             data-speed="300"
                             data-start="1100"
                             data-easing="easeOutExpo" data-end="9400" data-endspeed="300" data-endeasing="easeInSine">
                            <a target="_blank" href="https://wrapbootstrap.com/theme/atropos-responsive-website-template-WB05SR527"><img class="img-responsive" src="{{ asset('img/bonnie-enjoying-orders-small.png') }}" alt="Eat My Things" /></a>
                        </div>

                        @foreach ($todayDishes as $index => $todayDish)
                            <div class="tp-caption lft ltb"
                                 data-x="right" data-hoffset="-20"
                                 data-y="0"
                                 data-speed="600"
                                 data-start="{{ 1100 + 2500* $index }}"
                                 data-easing="easeOutExpo" data-end="{{ 3100 + 2500* $index }}" data-endspeed="600" data-endeasing="easeInSine">
                                <a href="{{ action('DishesController@show', array('dishes' => $todayDish, 'isBeingOrdered' => 0)) }}"><img src="{{ asset('userdata/' . $todayDish->user_id . '/dishes/' . $todayDish->id . '/picture_md.jpg') }}" alt="Image 2" style="border-radius: 10px;"></a>
                            </div>

                            <div class="tp-caption medium_bg_darkblue sft stb"
                                 data-x="720"
                                 data-y="200"
                                 data-speed="300"
                                 data-start="{{ 1400 + 2500* $index }}"
                                 data-easing="easeOutExpo" data-end="{{ 3300 + 2500* $index }}" data-endspeed="300" data-endeasing="easeInSine">{{ $todayDish->name }}
                            </div>

                            <div class="tp-caption medium_bg_orange sfb stb"
                                 data-x="720"
                                 data-y="160"
                                 data-speed="300"
                                 data-start="{{ 1700 + 2500* $index }}"
                                 data-easing="easeOutExpo" data-end="{{ 3200 + 2500* $index }}" data-endspeed="300" data-endeasing="easeInSine">{{ $todayDish->price }}
                            </div>
                        @endforeach

                    </li>

                    <!-- SLIDE -->
                    <li data-transition="curtain-2" data-slotamount="5" data-masterspeed="700">

                        <!-- COVER IMAGE -->
                        <img src="{{ asset('img/slider-bg2.jpg') }}" alt="" data-bgfit="cover" data-bgposition="left top" data-bgrepeat="no-repeat">

                        <div class="tp-caption large_text sft"
                             data-x="center"
                             data-y="100"
                             data-speed="300"
                             data-start="800"
                             data-easing="easeOutExpo">{{ trans('strings.homeCarousel3') }}
                        </div>

                        <div class="tp-caption medium_bold_red medium_light_red sfr"
                             data-x="center"
                             data-y="75"
                             data-speed="300"
                             data-start="1100"
                             data-easing="easeOutExpo">
                            <a href="https://wrapbootstrap.com/theme/atropos-responsive-website-template-WB05SR527" target="_blank">{{ trans('strings.homeCarousel4') }}</a>
                        </div>

                        @foreach ($chefsOfTheWeek as $index => $chefOfTheWeek)
                            <div class="tp-caption lfb text-center"
                                 data-x="{{ 270 + 210 * $index }}"
                                 data-y="200"
                                 data-speed="900"
                                 data-start="{{ 1700 + 300 * $index }}"
                                 data-easing="easeOutBack">
                                <a class="fsize20" href="{{ action('UsersController@show', array('users' => $chefOfTheWeek)) }}">
                                    <img class="block hover-scale" src="{{ asset('userdata/' . $chefOfTheWeek->id . '/profile_picture_md.jpg') }}" width="200" height="200" alt="" style="border-radius: 10px;"/>
                                    <strong>{{ $chefOfTheWeek->name }}</strong>
                                </a>
                            </div>
                        @endforeach

                    </li>


                </ul>

                <div class="tp-bannertimer"></div>
            </div>
        </div>
        <!-- /REVOLUTION SLIDER -->


        <section class="container text-center">
            <h1 class="text-center">
                {!! trans('strings.homeWelcome1') !!}   
            </h1>

            <div class="block-center">
              <img class="img-responsive" src="{{ asset('img/logo.png') }}" alt="Eat My Things" />
            </div>

            <h1 class="text-center">
              <span class="subtitle">{{ trans('strings.homeWelcome2') }}</span>
            </h1>

            <div class="row white-row">
                <h4>{{ trans('strings.homeSearch1') }}</h4>
                <div class="row">
                    <div class="col-md-4 col-md-offset-4">
                        <p class="nomargin">{{ trans('strings.homeSearch2') }}</p>

                          <div class="input-group">
                              <input id="pac-input" type="text" class="form-control" name="s" id="s" value="" placeholder="{{ trans('strings.homeSearch3') }}" />
                              <!--<div id="map-canvas" style="height: 400px; width: 100%; margin: 0; padding: 0;"></div>-->
                              <span class="input-group-btn">
                                <a id="searchDishesButton" class="btn btn-primary" href="/search/"><i class="fa fa-search"></i></a>
                              </span>
                          </div>

                    </div>
                    <div class="col-md-2 col-md-offset-5">
                        <a id="advancedSearchButton">{{ trans('strings.homeSearch4') }}</a>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-10 col-md-offset-1">
                        <section id="advancedSearch">
                          
                          <div class="col-md-7">

                            <!-- Name Form Input -->

                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        {!! Form::label('name', trans("strings.homeSearch5")) !!}
                                        {!! Form::text('name', null, ['class' => 'form-control input-lg']) !!}
                                    </div>
                                </div>
                            </div>

                            <!-- Rating Form Input -->

                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        {!! Form::label('rating', trans("strings.homeSearch6")) !!}
                                        {!! Form::number('rating', null, ['size' => '1', 'class' => 'form-control input-lg']) !!}
                                    </div>
                                </div>
                            </div>

                            <!-- Price Form Input -->

                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        {!! Form::label('price', trans("strings.homeSearch7")) !!}
                                        {!! Form::text('price', null, ['pattern' => '^\d*(\.\d{2}$)?', 'size' => '4', 'class' => 'form-control input-lg']) !!}
                                    </div>
                                </div>
                            </div>

                            <a id="cancelAdvancedSearchButton">{{ trans('strings.homeSearch8') }}</a>

                          </div>

                          <div class="col-md-5">
                            <img class="img-responsive" src="{{ asset('img/leo-searching.png') }}" alt="Eat My Things" />
                          </div>

                        </section>
                    </div>
                </div>

                <div class="row">
                  <div class="col-md-12">
                    <div id="map-canvas" style="height: 400px; width: 100%; margin: 0; padding: 0;"></div>
                  </div>
                </div>
            </div>
            
            <div class="row">
              <div class="col-md-2 col-md-offset-5">
                <img class="img-responsive" src="{{ asset('img/leo-hungry.png') }}" alt="Eat My Things" />
              </div>
            </div>
            <div class="row">
              <p class="lead">{{ trans('strings.homeBestDishes1') }}</p>
            </div>
        </section>

        <div id="shop">

            <section class="container">

                <div class="row">

                    @foreach ($dishes as $dish)
                        <div class="col-sm-6 col-md-3"><!-- item -->
                            <div class="item-box fixed-box">
                                <figure>
                                    <a class="item-hover" href="{{ action('DishesController@show', array('dishes' => $dish, 'isBeingOrdered' => 0)) }}">
                                        <span class="overlay color2"></span>
    										<span class="inner">
    											<span class="block fa fa-plus fsize20"></span>
    											{!! trans('strings.homeBestDishes2') !!}
    										</span>
                                    </a>
                                    <a href="{{ action('DishesController@show', array('dishes' => $dish, 'isBeingOrdered' => 1)) }}" class="btn btn-primary add_to_cart"><i class="fa fa-shopping-cart"></i> {{ trans('strings.homeBestDishes3') }}</a>
                                    <img class="img-responsive" src="{{ asset('userdata/' . $dish->user_id . '/dishes/' . $dish->id . '/' . 'picture_md.jpg') }}" width="100" height="100" alt="">
                                </figure>
                                <div class="item-box-desc">
                                    <h4>{{ $dish->name }}</h4>
                                    <small class="styleColor">{{ $dish->price }}</small>
                                </div>
                            </div>
                        </div>
                    @endforeach

                </div>

            </section>

        </div>

        <!-- CALLOUT -->
        <section class="container">

            <div class="row bs-callout nomargin-bottom">
                <div class="col-md-3">
                  <img class="img-responsive" src="{{ asset('img/brocks-paper-plane.png') }}" alt="Eat My Things" />
                </div>
                <div class="col-md-5 text-center">
                    <h3 class="padding20">{!! trans('strings.homeSubscribe1') !!}</h3>
                </div>
                <div class="col-md-4">

                    <p class="nomargin">{{ trans('strings.homeSubscribe2') }}</p>

                    <form method="get" action="#" class="input-group">
                        <input type="text" class="form-control" name="s" id="s" value="" placeholder="{{ trans('strings.homeSubscribe3') }}" />
							<span class="input-group-btn">
								<button class="btn btn-primary"><i class="fa fa-search"></i></button>
							</span>
                    </form>

                </div>
            </div>

        </section>
        <!-- /CALLOUT -->

    </div>
    <!-- /WRAPPER -->

    @include('partials._footer')

@endsection

@section('afterScripts')
    <script>
        $('#advancedSearch').hide();
        $('#advancedSearchButton').click(function() {
            $(this).hide();
            //$('#profileShow').hide(400);
            $('#advancedSearch').show(400);
            $('#cancelAdvancedSearchButton').show();
        });
        $('#cancelAdvancedSearchButton').click(function() {
            $(this).hide();
            $('#advancedSearch').hide(400);
            //$('#profileShow').show(400);
            $('#advancedSearchButton').show();
        });

        var map;
        var infoWindow;

        function initialize() {

          var userLat = {{ $location['lat'] }};
          var userLon = {{ $location['lon'] }};

  var mapOptions = {
    center: new google.maps.LatLng(userLat, userLon),
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
  var service = new google.maps.places.PlacesService(map);
  var request;

  @foreach ($dishesForMap as $dishForMap)
    var placeId = '{{ $dishForMap->google_place_id }}';
    request = {
      placeId: placeId
    };
    service.getDetails(request, function(place, status) {
    if (status == google.maps.places.PlacesServiceStatus.OK) {
      var marker = new google.maps.Marker({
        map: map,
        position: place.geometry.location
      });
      google.maps.event.addListener(marker, 'click', function() {
        infowindow.setContent("<div class='text-center'>{{ $dishForMap->name }} <br/> <img src='{{ asset('userdata/' . $dishForMap->user_id . '/dishes/' . $dishForMap->id . '/' . 'picture_sm.jpg') }}' alt='Dish Picture' /></div>");
        infowindow.open(map, this);
      });
    }
  });
  @endforeach

  /*var marker = new google.maps.Marker({
    map: map,
    anchorPoint: new google.maps.Point(0, -29)
  });*/

  google.maps.event.addListener(autocomplete, 'place_changed', function() {
    infowindow.close();
    //marker.setVisible(false);
    var place = autocomplete.getPlace();

    if (!place.geometry) {
      window.alert("Autocomplete's returned place contains no geometry");
      return;
    }
    
    // If the place has a geometry, then present it on a map.
    if (place.geometry.viewport) {
      map.fitBounds(place.geometry.viewport);
      var _href = $('#searchDishesButton').prop('href');
      $('#searchDishesButton').prop('href', '/search/' + place.place_id);
    } else {
      map.setCenter(place.geometry.location);
      map.setZoom(17);  // Why 17? Because it looks good.
    }
    //marker.setIcon(/** @type {google.maps.Icon} */({
    /*  url: place.icon,
      size: new google.maps.Size(71, 71),
      origin: new google.maps.Point(0, 0),
      anchor: new google.maps.Point(17, 34),
      scaledSize: new google.maps.Size(35, 35)
    }));
    marker.setPosition(place.geometry.location);
    marker.setVisible(true);*/

    var address = '';
    if (place.address_components) {
      address = [
        (place.address_components[0] && place.address_components[0].short_name || ''),
        (place.address_components[1] && place.address_components[1].short_name || ''),
        (place.address_components[2] && place.address_components[2].short_name || '')
      ].join(' ');
    }


    //infowindow.setContent('<div><strong>' + place.name + '</strong><br>' + address);
    //infowindow.open(map, marker);
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

/*var map2;
var infowindow2;

function initialize2() {
  var pyrmont = new google.maps.LatLng(-33.8665433, 151.1956316);

  map2 = new google.maps.Map(document.getElementById('map-canvas2'), {
    center: pyrmont,
    zoom: 15
  });

  var request = {
    location: pyrmont,
    radius: 500 //,
    //types: ['store']
  };
  infowindow2 = new google.maps.InfoWindow();
  //var service = new google.maps.places.PlacesService(map2);
  //service.nearbySearch(request, callback);
}

function callback(results, status) {
  if (status == google.maps.places.PlacesServiceStatus.OK) {
    for (var i = 0; i < results.length; i++) {
      createMarker(results[i]);
    }
  }
}

function createMarker(place) {
  var placeLoc = place.geometry.location;
  var marker = new google.maps.Marker({
    map: map2,
    position: place.geometry.location
  });

  google.maps.event.addListener(marker, 'click', function() {
    infowindow.setContent(place.name);
    infowindow.open(map2, this);
  });
}

google.maps.event.addDomListener(window, 'load', initialize2);*/

    </script>
@endsection