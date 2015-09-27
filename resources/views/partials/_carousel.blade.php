<div id="myCarousel" class="carousel slide" data-ride="carousel">
    <!-- Indicators -->
    <ol class="carousel-indicators">
        <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
        <li data-target="#myCarousel" data-slide-to="1"></li>
        <li data-target="#myCarousel" data-slide-to="2"></li>
    </ol>
    <div class="carousel-inner" role="listbox">
        <div class="item active">
            <img class="first-slide" src="{{ asset('/img/libs/carousel-1.jpg') }}" alt="First slide">
            <div class="container">
                <div class="carousel-caption" style="background-color: rgba(50,150,150,0.7); border-radius: 20px;">
                    <h1>Are you hungry and demanding?</h1>
                    <p>Food4U allows you to get delicious homemade food directly from people nearby. Try it, it's free!</p>
                    <p><a class="btn btn-lg btn-primary" href="#" role="button">I'm hungry!</a></p>
                </div>
            </div>
        </div>
        <div class="item">
            <img class="second-slide" src="{{ asset('/img/libs/carousel-2.jpg') }}" alt="Second slide">
            <div class="container">
                <div class="carousel-caption" style="background-color: rgba(50,150,150,0.7); border-radius: 20px;">
                    <h1>Discover one of Humanity's most remarkable achievements.</h1>
                    <p>Try out thousands of recipes from all around the World!</p>
                    <p><a class="btn btn-lg btn-primary" href="#" role="button">I want something special!</a></p>
                </div>
            </div>
        </div>
        <div class="item">
            <img class="third-slide" src="{{ asset('/img/libs/carousel-3.jpg') }}" alt="Third slide">
            <div class="container">
                <div class="carousel-caption" style="background-color: rgba(50,150,150,0.7); border-radius: 20px;">
                    <h1>Talented in cooking?</h1>
                    <p>Why not make a living out of it and share your recipes to many using our network?</p>
                    <p><a class="btn btn-lg btn-primary" href="#" role="button">Become an e-chef!</a></p>
                </div>
            </div>
        </div>
    </div>
    <a class="left carousel-control" href="#myCarousel" role="button" data-slide="prev">
        <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
        <span class="sr-only">Previous</span>
    </a>
    <a class="right carousel-control" href="#myCarousel" role="button" data-slide="next">
        <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
        <span class="sr-only">Next</span>
    </a>
</div>