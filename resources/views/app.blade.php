<!DOCTYPE html>
<html lang="en">
<!--[if IE 8]>			<html class="ie ie8"> <![endif]-->
<!--[if IE 9]>			<html class="ie ie9"> <![endif]-->
<!--[if gt IE 9]><!-->	<html> <!--<![endif]-->
<head>
    <meta charset="utf-8" />
    <title>Eat My Things</title>
    <meta name="keywords" content="HTML5,CSS3,Template" />
    <meta name="description" content="" />
    <meta name="Author" content="Dorin Grigoras [www.stepofweb.com]" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    <!-- mobile settings -->
    <meta name="viewport" content="width=device-width, maximum-scale=1, initial-scale=1, user-scalable=0" />

    <!-- WEB FONTS -->
    <link href="{{ asset('css/webfont.css') }}" rel="stylesheet" type="text/css" />

    <link rel="stylesheet" href="{{ asset('css/Jcrop.css') }}" type="text/css" />

    <link href="{{ asset('/assets/css/all.css') }}" rel="stylesheet">

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="{{ asset('js/html5shiv.min.js') }}"></script>
    <script src="{{ asset('js/respond.min.js') }}"></script>
    <![endif]-->
    <style>
      
      

      #pac-input:focus {
        border-color: #4d90fe;
      }

      .symbol {
  display: inline-block;
  border-radius: 50%;
  border: 5px double white;
  width: 30px;
  height: 30px;
}

.symbol-empty {
  background-color: red;
}

.symbol-filled {
  background-color: red;
}

    </style>
</head>

<body> <!-- Available classes for body: boxed , pattern1...pattern10 . Background Image - example add: data-background="assets/images/boxed_background/1.jpg"  -->

@include('partials._navbar')

@include('flash::message')

@yield('content')

<!-- Scripts -->
<!--<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.1/js/bootstrap.min.js"></script>-->
<script src="{{ asset('/assets/js/all.js') }}"></script>
<script src="{{ asset('js/Jcrop.js') }}"></script>
<script src="https://maps.googleapis.com/maps/api/js?v=3.exp&signed_in=true&libraries=places"></script>
<script src="{{ asset('js/bootstrap-rating.min.js') }}"></script>

@yield('footer')

<script>
    $('div.alert').not('.alert-important').delay(3000).slideUp(300);
</script>
<script src="{{ asset('js/jquery.dotdotdot.min.js') }}"></script>

<script>
    $('.ellipsis').dotdotdot();
    //$(document).ready(function() {
        //$('.ellipsis').dotdotdot();
    $('.nav-tabs').mouseout(function() {
        $('.ellipsis').dotdotdot();
    });

    //});
</script>

@yield('afterScripts')
<!-- Google Analytics: Change UA-XXXXX-X to be your site's ID. Go to http://www.google.com/analytics/ for more information. -->
<!--<script>
    (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
    (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
    m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
    })(window,document,'script','//www.google-analytics.com/analytics.js','ga');

    ga('create', 'UA-XXXXX-X', 'domainname.com');
    ga('send', 'pageview');
</script>
-->

</body>
</html>
