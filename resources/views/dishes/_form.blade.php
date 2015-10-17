<!-- Name Form Input -->

<div class="row">
    <div class="col-md-12">
        <div class="form-group">
            {!! Form::label('name', trans('strings.dishCreate2')) !!}
            {!! Form::text('name', null, ['class' => 'form-control input-lg']) !!}
        </div>
    </div>
</div>

<!-- Description Form Input -->

<div class="row">
    <div class="col-md-12">
        <div class="form-group">
            {!! Form::label('description', trans('strings.dishCreate3')) !!}
            {!! Form::textarea('description', null, ['class' => 'form-control input-lg']) !!}
        </div>
    </div>
</div>

<!-- Price Form Input -->

<div class="row">
    <div class="col-md-12">
        <div class="form-group">
            {!! Form::label('price', trans('strings.dishCreate4')) !!}
            {!! Form::number('price', 1, ['pattern' => '^\d*(\.\d{2}$)?', 'min' => '0.1', 'step' => '0.1', 'class' => 'form-control input-lg']) !!}
        </div>
    </div>
</div>

<!-- Picture Form Input -->

<div class="row">
    <div class="col-md-12">
        <div class="form-group">
            {!! Form::label('picture', trans('strings.dishCreate5')) !!}
            {!! Form::file('picture', ['class' => '', 'onChange' => 'readURL(this)']) !!}
        </div>
    </div>
</div>

<!-- Tag Form Input -->

<div class="row">
    <div class="col-md-12">
        <div class="form-group">
            {!! Form::label('tags_list', trans('strings.dishCreate6')) !!}
            {!! Form::select('tags_list[]', $tags, null, ['id' => 'tags_list', 'class' => 'form-control input-lg', 'multiple']) !!}
        </div>
    </div>
</div>


<input type="hidden" name="cropped" id="cropped" value="false" />
<input type="hidden" name="cropx" id="cropx" value="0" />
<input type="hidden" name="cropy" id="cropy" value="0" />
<input type="hidden" name="cropw" id="cropw" value="0" />
<input type="hidden" name="croph" id="croph" value="0" />

<!-- Add/Edit Dish Form Input -->

<div class="row">
    <div class="col-md-12">
        <a href="{{ route('my-account') }}" class="btn btn-default">Cancel</a>
        {!! Form::submit($submitButtonText, ['class' => 'btn btn-primary pull-right']) !!}
    </div>
</div>

@section('footer')
    <script type="text/javascript">

        $('#tags_list').select2({
            placeholder: 'Choose a tag'
        });

    </script>

    <script type="text/javascript" src="{{ asset('js/crop-script.js') }}"></script>

@endsection
