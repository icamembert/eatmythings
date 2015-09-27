@extends('app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-10 col-md-offset-1">
                <div class="panel panel-default">
                    <div class="panel-heading">Home</div>

                    <div class="panel-body">
                        @foreach($dishes as $dish)
                            <a href="{{  url('/dishes', $dish->id) }}"><h1>{{ $dish->name  }}</h1></a>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
