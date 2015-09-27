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
                        <li class="active">{{ trans('strings.breadSearchDishes') }}</li>
                    </ul>
                </div>
            </header>


            <section class="container white-row">

                <div class="row">

                    <div class="col-md-12">

                        <h2>{{ trans('strings.searchDishes1') }}</h2>

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

                </div>


                <div class="row">

                    @foreach ($dishesForMap as $dishForMap)
                        <div class="col-sm-6 col-md-3"><!-- item -->
                            <div class="item-box fixed-box">
                                <figure>
                                    <a class="item-hover" href="{{ action('DishesController@show', array('dishes' => $dishForMap, 'isBeingOrdered' => 0)) }}">
                                        <span class="overlay color2"></span>
    										<span class="inner">
    											<span class="block fa fa-plus fsize20"></span>
    											{!! trans('strings.homeBestDishes2') !!}
    										</span>
                                    </a>
                                    <a href="{{ action('DishesController@show', array('dishes' => $dishForMap, 'isBeingOrdered' => 1)) }}" class="btn btn-primary add_to_cart"><i class="fa fa-shopping-cart"></i> {{ trans('strings.homeBestDishes3') }}</a>
                                    <img class="img-responsive" src="{{ asset('userdata/' . $dishForMap->user_id . '/dishes/' . $dishForMap->id . '/' . 'picture_md.jpg') }}" width="100" height="100" alt="">
                                </figure>
                                <div class="item-box-desc">
                                    <h4>{{ $dishForMap->name }}</h4>
                                    <small class="styleColor">{{ $dishForMap->price }}</small>
                                </div>
                            </div>
                        </div>
                    @endforeach

                </div>

                <div class="row">
                	{!! $dishesForMap->render() !!}
                </div>


            </section>

        </div>
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

          var geocoder = new google.maps.Geocoder;
          var centerPlaceId = '{{ $dishesForMap->first()->city_google_place_id }}';

          geocoder.geocode({'placeId': centerPlaceId}, function(results, status) {
		    if (status === google.maps.GeocoderStatus.OK) {
		      if (results[0]) {
		       var searchLocation = results[0].geometry.location;
		       var mapOptions = {
				    center: searchLocation,
				    zoom: 11,
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
		    var placeId = '{{ $dishForMap->address_google_place_id }}';
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
		      } else {
		        window.alert('No results found');
		      }
		    } else {
		      window.alert('Geocoder failed due to: ' + status);
		    }
		  });

          

		  
		  

		  

		  
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
