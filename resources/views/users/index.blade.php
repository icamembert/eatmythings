@extends('app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-10 col-md-offset-1">
                <div class="panel panel-default">
                    <div class="panel-heading">Home</div>

                    <div class="panel-body">
                        @foreach($users as $user)
                            <a href="{{  url('/users', $user->id) }}"><h1>{{ $user->name  }}</h1></a>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection