@extends('app')

@section('content')

    <!-- WRAPPER -->
    <div id="wrapper">

        <div id="shop">

            <!-- PAGE TITLE -->
            <header id="page-title">
                <div class="container">
                    <h1>{{ trans('strings.breadContactUs') }}</h1>

                    <ul class="breadcrumb">
                        <li><a href="{{ action('HomeController@index') }}">{{ trans('strings.breadHome') }}</a></li>
                        <li class="active">{{ trans('strings.breadContactUs') }}</li>
                    </ul>
                </div>
            </header>


            <section id="mainFrame" class="container white-row">

                <div class="row">
                    <div class="col-md-6">
                        <h2>Contact Us</h2>
                    </div>
                </div>

                <div class="row">

                    <div class="col-md-8 col-md-offset-2">

                        <img class="img-responsive center-block" src="{{ asset('img/all-together.png') }}" alt="Bonnie" title="Bonnie" width="70%" />

                        <p class="text-center">
                        	Got any question? Please send us an email by clicking <a href="">here</a>, we will get back to you shortly!
                        </p>

                    </div>

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