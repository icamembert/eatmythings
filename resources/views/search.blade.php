@extends('app')

@section('content')


    <!-- WRAPPER -->
    <div id="wrapper">

        <div id="shop">

            <!-- PAGE TITLE -->
            <header id="page-title">
                <div class="container">
                    <h1>{{ trans('strings.breadSearchDishes') }}</h1>

                    <ul class="breadcrumb">
                        <li><a href="{{ action('HomeController@index') }}">{{ trans('strings.breadHome') }}</a></li>
                        <li class="active">{{ trans('strings.breadSearchDishes') }}</li>
                    </ul>
                </div>
            </header>

            {!! Form::open(['id' => 'searchForm', 'url' => 'search', 'method' => 'GET']) !!}

	            <section class="container">

	            	

	                <div class="row white-row">

	                    <div class="col-md-12">

	                        <h2>{{ trans('strings.searchSection1Header') }}</h2>

	                        <div class="row">
			                    <div class="col-md-4 col-md-offset-4">
			                        <p class="nomargin">{{ trans('strings.searchCityTextLabel') }}</p>

									<div class="input-group">
										<input id="pac-input" type="text" class="form-control" placeholder="{{ trans('strings.searchCityTextPlaceholder') }}" />
										{!! Form::input('hidden', 'googlePlaceId', $searchedGooglePlaceId, ['id' => 'googlePlaceId', 'class' => 'form-control']) !!}
										<span class="input-group-btn">
											<a id="searchDishesButton" class="btn btn-primary"><i class="fa fa-search"></i></a>
										</span>
									</div>

			                    </div>
			                </div>

			                <div class="row">
			                	<div class="col-md-2 col-md-offset-5">
			                        <a id="advancedSearchButton">{{ trans('strings.searchAdvancedSearchLink') }}</a>
			                    </div>
			                </div>

			                <div class="row">
			                    <div class="col-md-10 col-md-offset-1">
			                        <section id="advancedSearch" style="display: none">
			                          
		                          		<div class="col-md-8">   

				                            <div class="row">

				                            	<!-- Name Form Input -->

				                                <div class="col-md-8">
				                                    <div class="form-group">
				                                        {!! Form::label('name', trans("strings.searchKeywordTextLabel")) !!}
				                                        {!! Form::text('name', $name, ['class' => 'form-control input-lg', 'placeholder' => trans("strings.searchKeywordTextPlaceholder")]) !!}
				                                    </div>
				                                </div>

				                                <!-- Radius Form Input -->

				                                <div class="col-md-4">
				                                    <div class="form-group">
				                                        {!! Form::label('radius', trans("strings.searchRadiusSelectLabel")) !!}
				                                        {!! Form::select('radius', array('50' => '50 km', '25' => '25 km', '15' => '15 km', '10' => '10 km', '5' => '5 km'), '$radius', ['class' => 'form-control input-lg']) !!}
				                                    </div>
				                                </div>
				                            </div>

				                            

				                            <div class="row">

				                            	<!-- Rating Form Input -->

				                                <div class="col-md-6">
				                                    <div class="form-group">
				                                        {!! Form::label('rating', trans("strings.searchRatingHiddenLabel")) !!}
				                                        <div class="row text-center">
		                                    				<h2>{!! Form::input('hidden', 'rating', $rating, ['class' => 'form-control rating']) !!}</h2>
		                                    			</div>
				                                    </div>
				                                </div>

				                                <!-- Price Form Input -->

				                                <div class="col-md-6">
				                                    <div class="form-group">
				                                        {!! Form::label('price', trans("strings.searchPriceNumberLabel")) !!}
				                                        {!! Form::number('price', $price, ['pattern' => '^\d*(\.\d{2}$)?', 'min' => '1', 'step' => '1', 'class' => 'form-control input-lg']) !!}
				                                    </div>
				                                </div>
				                            </div>

				                            <a id="cancelAdvancedSearchButton">{{ trans('strings.searchAdvancedSearchCancelLink') }}</a>

			                        	</div>

										<div class="col-md-4">
											<img class="img-responsive" src="{{ asset('img/leo-searching.png') }}" alt="{{ trans('strings.searchLeoSearchingStickerAlt') }}" />
										</div>

			                        </section>
			                    </div>
			                </div>

	                	</div>
	                </div>

	                <div class="divider styleColor"><!-- divider -->
	                    <i class="fa fa-chevron-down"></i>
	                </div>

	                <div class="row white-row">
		                <div class="row">

		                	<h2>{{ trans('strings.searchSection2Header') }}</h2>	                	

	                        <div class="row">
	                            
	                            @if ($dishes->count()) 
		                            <div class="col-md-10 col-md-offset-1" style="display: flex; align-items: center;">
			                            
			                            <div class="col-md-3">
	                        				<h4>{{ $dishes->total() }} {{ trans('strings.searchNumberOfResultsFound') }}</h4>
	                        			</div>

			                            <div class="col-md-3">
					                    	<img id="leoHappySearch" class="img-responsive" src="{{ asset('img/leo-happy-search.png') }}" alt="{{ trans('strings.searchLeoHappySearchStickerAlt') }}" />
				                      	</div>

			                            <!-- Sort By Form Input -->

			                            <div class="col-md-3">
			                                <div class="form-group">
			                                    {!! Form::label('sortBy', trans("strings.searchSortBySelectLabel")) !!}
			                                    {!! Form::select('sortBy', array('bestRating' => trans("strings.searchSortBySelectOption1"), 'bestPrice' => trans("strings.searchSortBySelectOption2")), $sortBy, ['class' => 'form-control input-lg']) !!}
			                                </div>
			                            </div>
			                        
			                        	<!-- Number Of Results Per Page Form Input -->

			                            <div class="col-md-3">
			                                <div class="form-group">
			                                    {!! Form::label('resultsPerPage', trans("strings.searchResultsPerPageSelectLabel")) !!}
			                                    {!! Form::select('resultsPerPage', array('8' => '8', '20' => '20', '40' => '40'), $resultsPerPage, ['class' => 'form-control input-lg']) !!}
			                                </div>
			                            </div>

			                     	</div>
		                     	@else
		                     		<div class="col-md-12 text-center">
		                     			<h4>{{ trans('strings.searchNoResults') }}</h4>
		                     		</div>
		                     	@endif

	                        </div>

		                    @foreach ($dishes as $dish)
		                        <div class="col-sm-6 col-md-3"><!-- item -->
		                            <div class="item-box fixed-box">
		                                <figure>
		                                    <a class="item-hover" href="{{ action('DishesController@show', array('dishes' => $dish, 'isBeingOrdered' => 0)) }}">
		                                        <span class="overlay color2"></span>
		    										<span class="inner">
		    											<span class="block fa fa-plus fsize20"></span>
		    											{!! trans('strings.searchDishResultsPictureSeeMoreLink') !!}
		    										</span>
		                                    </a>
		                                    <a href="{{ action('DishesController@show', array('dishes' => $dish, 'isBeingOrdered' => 1)) }}" class="btn btn-primary add_to_cart"><i class="fa fa-shopping-cart"></i> {{ trans('strings.searchDishResultsPictureOrderLink') }}</a>
		                                    <img class="img-responsive" src="{{ asset('userdata/' . $dish->user_id . '/dishes/' . $dish->id . '/' . 'picture_md.jpg') }}" width="100" height="100" alt="{{ trans('strings.searchDishResultsPictureAlt') }}">
		                                </figure>
		                                <div class="item-box-desc">
		                                    <h4>{{ $dish->name }}</h4>
		                                    <small class="styleColor">{{ $dish->price }}</small>
		                                </div>
		                            </div>
		                        </div>
		                    @endforeach

		                </div>

		                <div class="row">
		                	{!! $dishes->appends(['googlePlaceId' => $searchedGooglePlaceId, 'name' => $name, 'radius' => $radius, 'rating' => $rating, 'price' => $price, 'sortBy' => $sortBy, 'resultsPerPage' => $resultsPerPage])->render() !!}
		                </div>

		                <div class="row">
		                  <div class="col-md-12">
		                    <div id="map-canvas" style="height: 400px; width: 100%; margin: 0; padding: 0;"></div>
		                  </div>
		                </div>

	            	</div>

	            </section>

            {!! Form::close() !!}

        </div>
    </div>
    <!-- /WRAPPER -->

    @include('partials._footer')

@endsection

@section('afterScripts')

    <script>

        $('#advancedSearchButton').click(function() {
            $(this).hide();
            $('#leoHappySearch').hide(400);
            $('#advancedSearch').show(400);
            $('#cancelAdvancedSearchButton').show();
        });
        $('#cancelAdvancedSearchButton').click(function() {
            $(this).hide();
            $('#advancedSearch').hide(400);
            $('#leoHappySearch').show(400);
            $('#advancedSearchButton').show();
        });

        function initializeAutocomplete() {

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

			var linkToFirstPredictionAndSubmit = function(predictions) {

				if (predictions) {
					$('#googlePlaceId').val(predictions[0].place_id);
					$('#searchDishesButton')[0].click();
				}

			}

			google.maps.event.addListener(autocomplete, 'place_changed', function() {

				var place = autocomplete.getPlace();

				if (place.geometry) {
					$('#googlePlaceId').val(place.place_id);
					$('#searchDishesButton')[0].click();
				} else {
					if ($('#pac-input').val())
						autocompleteService.getQueryPredictions({input: input.value}, linkToFirstPredictionAndSubmit);
				}

			});

			$('#pac-input').mouseleave(function() {

				if ($('#pac-input').val())
        			autocompleteService.getQueryPredictions({input: input.value}, linkToFirstPrediction);

      		});

			$('#pac-input').keypress(function(e) {

		        if (e.keyCode == 13) {
					e.preventDefault();
					if ($('#pac-input').val())
						autocompleteService.getQueryPredictions({input: input.value}, linkToFirstPredictionAndSubmit);
		        }

			});

      		$('#searchDishesButton').click(function() {
      			if ($('#pac-input').val())
      				$('#searchForm').submit();
      		});

        	$('#sortBy').change(function() {
      			$('#searchForm').submit();
      		});

      		$('#resultsPerPage').change(function() {
      			$('#searchForm').submit();
      		});

        }



        function initializeMap() {

			var geocoder = new google.maps.Geocoder;
			var centerPlaceId = '{{ $searchedGooglePlaceId }}';

			geocoder.geocode({'placeId': centerPlaceId}, function(results, status) {

				if (status === google.maps.GeocoderStatus.OK) {

				if (results[0]) {

				var searchLocation = results[0].geometry.location;
				var mapOptions = {
					center: searchLocation,
					zoom: 11,
				};
				var map = new google.maps.Map(document.getElementById('map-canvas'), mapOptions);
				var input = $('#pac-input');

				input.val(results[0].formatted_address);

				var infowindow = new google.maps.InfoWindow();
				var service = new google.maps.places.PlacesService(map);
				var request;

				@foreach ($dishes as $dish)

					var placeId = '{{ $dish->address_google_place_id }}';

					request = {
						placeId: placeId
					};

					service.getDetails(request, function(place, status) {
					
						if (status == google.maps.places.PlacesServiceStatus.OK) {
							var marker = new google.maps.Marker({
								map: map,
								position: place.geometry.location,
								icon: "{{ asset('img/bonnie-ready-marker.png') }}"
							});


							google.maps.event.addListener(marker, 'click', function() {
								infowindow.setContent("<div class='text-center'><a href='{{ action('DishesController@show', array('dishes' => $dish, 'isBeingOrdered' => 0)) }}'>{{ $dish->name }} <br/> <img src='{{ asset('userdata/' . $dish->user_id . '/dishes/' . $dish->id . '/' . 'picture_sm.jpg') }}' alt='Dish Picture' /></a></div>");
								infowindow.open(map, this);
							});

						}
					});

				@endforeach

				} else {

					window.alert('No results found');

				}
				} else {

					window.alert('Geocoder failed due to: ' + status);

				}

			});
		  
		}

		google.maps.event.addDomListener(window, 'load', initializeAutocomplete);
		google.maps.event.addDomListener(window, 'load', initializeMap);

    </script>

@endsection
