@extends('app')

@section('content')

    <!-- WRAPPER -->
    <div id="wrapper">

        <div id="shop">

            <!-- PAGE TITLE -->
            <header id="page-title">
                <div class="container">
                    <h1>{{ trans('strings.breadBecomeAChef') }}</h1>

                    <ul class="breadcrumb">
                        <li><a href="{{ action('HomeController@index') }}">{{ trans('strings.breadHome') }}</a></li>
                        <li class="active">{{ trans('strings.breadBecomeAChef') }}</li>
                    </ul>
                </div>
            </header>


            <section id="mainFrame" class="container white-row">

                <div class="row">
                    <div class="col-md-12">
                        <h2>Why & How to become a chef?</h2>

                        <p>
                            If you already know what you want, then you can easily become a chef right away by creating an account <a href="{{ action('Auth\AuthController@getRegister') }}">here</a>!
                            Otherwise, here's a selection of the most frequently asked questions:
                    </div>
                </div>

                <div class="row">

                    <div class="col-md-8 col-md-offset-2">

                        <img class="img-responsive center-block" src="{{ asset('img/bonnie-leo-questions.png') }}" alt="Bonnie" title="Bonnie" width="70%" />

                        <div class="panel-group" id="accordion">
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    <h4 class="panel-title">
                                        <a data-toggle="collapse" data-parent="#accordion" href="#acordion1">
                                            <i class="fa fa-check"></i>
                                            I like to cook, how's Eat My Things going to help me in living my passion fully?
                                        </a>
                                    </h4>
                                </div>
                                <div id="acordion1" class="collapse in">
                                    <div class="panel-body">
                                        "Fully", you said it! Through our network, you can make become visible what you've been talented at for all these years.
                                        You can also make a living out of it at the same time. If you believe being paid for living your passion is good, then
                                        you're in the right place!
                                    </div>
                                </div>
                            </div>
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    <h4 class="panel-title">
                                        <a data-toggle="collapse" data-parent="#accordion" href="#acordion2">
                                            <i class="fa fa-check"></i>
                                            Does Eat My Things charge us anything?
                                        </a>
                                    </h4>
                                </div>
                                <div id="acordion2" class="collapse">
                                    <div class="panel-body">
                                        No, absolutely not. Everything you do here is free of charge, we currently plan on making money through some advertising,
                                        but we guarantee we will never ever put a tax on your activities through our site.
                                    </div>
                                </div>
                            </div>
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    <h4 class="panel-title">
                                        <a data-toggle="collapse" data-parent="#accordion" href="#acordion3">
                                            <i class="fa fa-check"></i>
                                            Why don't you select chefs a minimum?
                                        </a>
                                    </h4>
                                </div>
                                <div id="acordion3" class="collapse">
                                    <div class="panel-body">
                                        We believe anyone can cook and should be able to start showing their talent easily and quickly. We also believe users' ratings & reviews
                                        will ensure the quality of the service.
                                    </div>
                                </div>
                            </div>
                        </div>

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