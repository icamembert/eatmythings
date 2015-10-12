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
        </section>




        <!-- PARALLAX -->
      <section class="container text-center parallax margin-footer" data-stellar-background-ratio="0.3" style="background-image: url('img/food.jpg');">
        <span class="overlay"></span>

        <div class="cold-md-4 cold-md-offset-4">
          <div class="row">
            <h4>{{ trans('strings.homeSearch1') }}</h4>
            <div class="row">
                <div class="col-md-4 col-md-offset-4">
                    <p class="nomargin">{{ trans('strings.homeSearch2') }}</p>

                      {!! Form::open(['id' => 'searchForm', 'url' => 'search', 'method' => 'GET']) !!}

                        <div class="input-group">
                            <input id="pac-input" type="text" class="form-control" placeholder="{{ trans('strings.homeSearch3') }}" />
                            {!! Form::input('hidden', 'googlePlaceId', null, ['id' => 'googlePlaceId', 'class' => 'form-control']) !!}
                            <span class="input-group-btn">
                              <a id="searchDishesButton" class="btn btn-primary"><i class="fa fa-search"></i></a>
                            </span>
                        </div>

                      {!! Form::close() !!}
                </div>
            </div>
          </div>

        </div>

      </section>
      <!-- PARALLAX -->




        <div id="shop">

            <section class="container text-center">

                <div class="row">

                  <div class="row">
                    <div class="col-md-2 col-md-offset-5">
                      <img class="img-responsive" src="{{ asset('img/leo-hungry.png') }}" alt="Eat My Things" />
                    </div>
                  </div>
                  <div class="row">
                    <p class="lead">{{ trans('strings.homeBestDishes1') }}</p>
                  </div>

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
          $('#searchDishesButton')[0].click()
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

    }

    google.maps.event.addDomListener(window, 'load', initializeAutocomplete);

  </script>

@endsection