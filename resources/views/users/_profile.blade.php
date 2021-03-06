<div class="row white-row">

    @if ($user->isMe())
        <h2>{{ trans('strings.profileSummary1') }}</h2>
    @else
        <h2>{{ Lang::get('strings.profileSummary2', ['userName' => $user->name]) }}</h2>
    @endif

    <div class="row">
        <div id="profileShow">
            <div class="col-md-3">
                <img class="img-responsive" src="{{ asset($profilePicturePath) }}" alt="Profile Picture" width="300" height="300" />
                <h3 class="text-center">{{ $user->name }}</h3>
            </div>
            <div class="col-md-9">
                <ul>
                    @if ($user->isChef())
                        <li>{{ trans('strings.profileSummary3') }} {{ $user->rating }}</li>
                        <li>{{ trans('strings.profileSummary4') }} {{ $user->rating }}</li>
                        <li>{{ trans('strings.profileSummary5') }} {{ $user->dishes->count() }}</li>
                    @endif
                    @if ($user->isMe())
                        <li>{{ trans('strings.profileSummary6') }} {{ $user->email }}</li>
                    @endif
                    <li id="locationListElement">{{ trans('strings.profileSummary7') }}</li>
                    <li>{{ trans('strings.profileSummary8') }} {{ $user->about }}</li>
                </ul>
                @if ($user->isMe())
                    <button id="editProfileButton" class="btn btn-primary">{{ trans('strings.profileSummary9') }}</button>
                @endif
            </div>
        </div>
        @if ($user->isMe())
            <div id="profileEdit" class="col-md-12" style="display: none">
                @if (count($errors) > 0)
                        <div class="alert alert-danger">
                            <strong>Whoops!</strong> There were some problems with your input.<br><br>
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                                    </ul>
                        </div>
                @endif
                <div class="col-md-6">
                    
                    <div class="row">
                        <div id="JcropContainer" class="col-md-12" style="padding-top: 15px;">
                                <img id="JcropPicture" class="img-responsive" src="{{ asset($profilePicturePath) }}" alt=""/>
                                <canvas id="JcropCanvas" width="2000" height="2000" style="display: none;"></canvas>
                        </div>
                    </div>

                    <!-- Picture Form Input -->

                    <div id="imageChoosePanel" class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                {!! Form::label('picture', trans('strings.profileSummary11')) !!}
                                {!! Form::file('picture', ['class' => '', 'onChange' => 'readURL(this)']) !!}
                            </div>
                        </div>
                    </div>

                    <div id="imageCropButtonsPanel" class="row loading-progress" style="display: none; padding-top: 15px">
                        <div class="col-md-6">
                            <a id="imageCropCancelButton" class="btn btn-primary">Cancel</a>
                        </div>
                        <div class="col-md-6">
                            <a id="imageCropButton" class="btn btn-primary pull-right">Crop!</a>
                        </div>
                    </div>

                </div>
                
                <div class="col-md-6">
                    {!! Form::model($user, ['id' => 'profileForm', 'method' => 'PATCH', 'action' => ['UsersController@update', $user->id], 'files' => true]) !!}
                        @include('users._form', ['submitButtonText' => trans('strings.profileSummary13')])
                    {!! Form::close() !!}

                </div>

            </div>
        @endif
    </div>
</div>