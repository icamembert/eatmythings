@extends('app')

@section('content')

    <!-- WRAPPER -->
    <div id="wrapper">

        <div id="shop">

            <!-- PAGE TITLE -->
            <header id="page-title">
                <div class="container">
                    <h1>{{ trans('strings.breadHowDoesItWork') }}</h1>

                    <ul class="breadcrumb">
                        <li><a href="{{ action('HomeController@index') }}">{{ trans('strings.breadHome') }}</a></li>
                        <li class="active">{{ trans('strings.breadHowDoesItWork') }}</li>
                    </ul>
                </div>
            </header>


            <section id="mainFrame" class="container white-row">

                <div class="row">
                    <div class="col-md-12">
                        <h2>How does it work?</h2>

                        <p>
                            Here's all the information you might want to know about Eat My Things:
                        </p>    
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
                                            How do I order food on Eat My Things?
                                        </a>
                                    </h4>
                                </div>
                                <div id="acordion1" class="collapse in">
                                    <div class="panel-body">
                                        The first step is: signing up! We know it's always the same words and so many websites will tell you the same thing.
                                        Boring, right? But anyway it's still true, just a few seconds and you're good to go! After that, just use the search
                                        function to find dishes around your place and choose the things you think will make you have a good meal. Add them to
                                        your cart and place your order, telling the Chef when and how you want to get the food. The chef will contact you if
                                        any additional information is needed. That's it!
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
                                        but we guarantee we will never ever put a tax on your meals!
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
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    <h4 class="panel-title">
                                        <a data-toggle="collapse" data-parent="#accordion" href="#acordion4">
                                            <i class="fa fa-check"></i>
                                            Can I pay online using PayPal or a Credit Card?
                                        </a>
                                    </h4>
                                </div>
                                <div id="acordion4" class="collapse">
                                    <div class="panel-body">
                                        Not yet but we're working hard on it!
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