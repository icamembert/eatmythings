@extends('app')

@section('content')

    <!-- WRAPPER -->
    <div id="wrapper">

        <div id="shop">

            <!-- PAGE TITLE -->
            <header id="page-title">
                <div class="container">
                    <h1>{{ trans('strings.breadAboutUs') }}</h1>

                    <ul class="breadcrumb">
                        <li><a href="{{ action('HomeController@index') }}">{{ trans('strings.breadHome') }}</a></li>
                        <li class="active">{{ trans('strings.breadAboutUs') }}</li>
                    </ul>
                </div>
            </header>


            <section id="mainFrame" class="container white-row">

                <div class="row">
     
                    <div class="col-md-6">

                        <h2>About Us</h2>

                        <p>

                        </p>

                    </div>

                </div>

                <div class="row">

                	<img class="img-responsive pull-left" src="{{ asset('img/bonnie-ready.png') }}" alt="Bonnie" title="Bonnie" width="20%" />
                	
                	<p>
                		<h3>Bonnie</h3>

                		Bonnie was born as a white monkey but she has now become brown. She's extremely obsessed with all kinds of
                		food and takes pictures of everything she eats. She wants to share the marvelous things she cooks, and she
                		can speak Korean, English, Chinese, and French, so that might be useful.
                	</p>

                </div>

                <div class="divider styleColor"><!-- divider -->
        			<i class="bg-white fa fa-star"></i>
    			</div>

                <div class="row">

                	<img class="img-responsive pull-right" src="{{ asset('img/leo-waving-hand.png') }}" alt="Leo" title="Leo" width="20%" />

                	<p>
                		<h3 class="text-right">Leo</h3>
                		
                		Even though Leo is a lion (shiny one), he doesn't get along well with cats (especially stupid ones). He's
                		the first engineer lion who was authorized to work for a company outside of a cage. He likes to make websites,
                		but his main hobby is to eat significant amounts of food. His favorite dish is camembert pasta.
                	</p>

                </div>

                <div class="divider styleColor"><!-- divider -->
        			<i class="bg-white fa fa-star"></i>
    			</div>

                <div class="row">

                	<img class="img-responsive pull-left" src="{{ asset('img/brocks-computers.png') }}" alt="Angry Brocks" title="Angry Brocks" width="30%" />

                	<p>
                		<h3>Angry Brocks</h3>
                		
                		These guys are a tribe of broccolis who escaped from the market because they were getting sick of seeing people
                		not eating well. They are very angry. They want to show the world that healthy ingredients can become yummy food.
                	</p>

                </div>


            </section>

        </div>
    </div>
    <!-- /WRAPPER -->
    
@endsection

@section('afterScripts')
	
	<!--<script type="text/jsx">

    	var AboutBlock = React.createClass({

    		render: function() {

    			return <div>Bonnie</div>;

    		}

    	});

    	React.render(<AboutBlock />, document.body);

    </script>-->

@endsection