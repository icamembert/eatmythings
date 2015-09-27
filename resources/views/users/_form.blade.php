<!-- Email Form Input -->

<div class="row">
    <div class="form-group">
        {!! Form::label('email', trans('strings.profileSummary6')) !!}
        {!! Form::email('email', null, ['class' => 'form-control']) !!}
    </div>
</div>

<!-- Location Form Input -->

<div class="row">
    <div class="form-group">
        {!! Form::label('location', trans('strings.profileSummary7')) !!}
        {!! Form::text('google_place_id', null, ['id' => 'pac-input', 'class' => 'form-control', 'placeholder' => trans('strings.profileSummary10')]) !!}
    </div>
</div>

<div id="map-canvas"></div>
<input type="hidden" name="place_id" id="placeId" />

<!-- About Form Input -->

<div class="row">
    <div class="form-group">
        {!! Form::label('about', trans('strings.profileSummary8')) !!}
        {!! Form::textarea('about', null, ['class' => 'form-control']) !!}
    </div>
</div>

<!-- Picture Form Input -->

<div class="row">
    <div class="col-md-12">
        <div class="form-group">
            {!! Form::label('picture', trans('strings.profileSummary11')) !!}
            {!! Form::file('picture', ['class' => '', 'onChange' => 'readURL(this)']) !!}
        </div>
    </div>
</div>

<input type="hidden" name="cropx" id="cropx" value="0" />
<input type="hidden" name="cropy" id="cropy" value="0" />
<input type="hidden" name="cropw" id="cropw" value="0" />
<input type="hidden" name="croph" id="croph" value="0" />

<!-- Edit Profile Form Input -->

<div class="row">
    <div class="col-md-6">
        <a id="cancelEditProfileButton" class="btn btn-primary">{{ trans('strings.profileSummary12') }}</a>
    </div>
    <div class="col-md-6">
        {!! Form::submit($submitButtonText, ['class' => 'btn btn-primary pull-right']) !!}
    </div>
</div>