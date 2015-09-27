var elixir = require('laravel-elixir');

/*
 |--------------------------------------------------------------------------
 | Elixir Asset Management
 |--------------------------------------------------------------------------
 |
 | Elixir provides a clean, fluent API for defining some basic Gulp tasks
 | for your Laravel application. By default, we are compiling the Less
 | file for our application, as well as publishing vendor resources.
 |
 */

elixir(function(mix) {

    mix.less([
        'app.less'
    ], 'public/css');

    mix.styles([
        'libs/bootstrap.min.css',

        'libs/select2.min.css',
        '../assets/bower/eonasdan-bootstrap-datetimepicker/build/css/bootstrap-datetimepicker.min.css',
        '../assets/Atropos/HTML/assets/css/font-awesome.css',
        '../assets/Atropos/HTML/assets/plugins/owl-carousel/owl.carousel.css',
        '../assets/Atropos/HTML/assets/plugins/owl-carousel/owl.theme.css',
        '../assets/Atropos/HTML/assets/plugins/owl-carousel/owl.transitions.css',
        '../assets/Atropos/HTML/assets/plugins/magnific-popup/magnific-popup.css',
        '../assets/Atropos/HTML/assets/css/animate.css',
        '../assets/Atropos/HTML/assets/css/superslides.css',
        '../assets/Atropos/HTML/assets/plugins/revolution-slider/css/settings.css',
        '../assets/Atropos/HTML/assets/css/essentials.css',
        '../assets/Atropos/HTML/assets/css/layout.css',
        '../assets/Atropos/HTML/assets/css/layout-responsive.css',
        '../assets/Atropos/HTML/assets/css/shop.css',
        '../assets/Atropos/HTML/assets/css/color_scheme/red.css'
    ], 'public/assets/css', 'resources/css');

    mix.scripts([
        '../assets/Atropos/HTML/assets/plugins/modernizr.min.js',
        '../assets/bower/jquery/dist/jquery.js',
        '../assets/bower/moment/min/moment.min.js',
        '../assets/bower/bootstrap/dist/js/bootstrap.js',
        'libs/select2.min.js',
        '../assets/bower/eonasdan-bootstrap-datetimepicker/build/js/bootstrap-datetimepicker.min.js',
        '../assets/Atropos/HTML/assets/plugins/jquery.easing.1.3.js',
        '../assets/Atropos/HTML/assets/plugins/jquery.cookie.js',
        '../assets/Atropos/HTML/assets/plugins/jquery.appear.js',
        '../assets/Atropos/HTML/assets/plugins/jquery.isotope.js',
        '../assets/Atropos/HTML/assets/plugins/masonry.js',
        '../assets/Atropos/HTML/assets/plugins/magnific-popup/jquery.magnific-popup.js',
        '../assets/Atropos/HTML/assets/plugins/owl-carousel/owl.carousel.js',
        '../assets/Atropos/HTML/assets/plugins/stellar/jquery.stellar.js',
        '../assets/Atropos/HTML/assets/plugins/knob/js/jquery.knob.js',
        '../assets/Atropos/HTML/assets/plugins/jquery.backstretch.min.js',
        '../assets/Atropos/HTML/assets/plugins/superslides/dist/jquery.superslides.js',
        '../assets/Atropos/HTML/assets/plugins/mediaelement/build/mediaelement-and-player.js',
        '../assets/Atropos/HTML/assets/plugins/revolution-slider/js/jquery.themepunch.tools.min.js',
        '../assets/Atropos/HTML/assets/plugins/revolution-slider/js/jquery.themepunch.revolution.js',
        '../assets/Atropos/HTML/assets/js/slider_revolution.js',
        '../assets/Atropos/HTML/assets/js/scripts.js'
    ], 'public/assets/js', 'resources/js');
});
