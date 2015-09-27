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



<input type="hidden" name="cropx" id="cropx" value="0" />
<input type="hidden" name="cropy" id="cropy" value="0" />
<input type="hidden" name="cropw" id="cropw" value="0" />
<input type="hidden" name="croph" id="croph" value="0" />

<!-- Add/Edit Dish Form Input -->

<div class="row">
    <div class="col-md-12">
        {!! Form::submit($submitButtonText, ['class' => 'btn btn-primary pull-right']) !!}
    </div>
</div>

@section('footer')
    <script type="text/javascript">

        var pictureRatio = 0;

        $('#tags_list').select2({
            placeholder: 'Choose a tag'
        });
        function readURL(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();

                reader.onload = function (e) {
                    $('#pictureViewer')
                            .attr('src', e.target.result);
                            //.width(150)
                            //.height(200);
                    $('#pictureViewer').one('load', function() {
                        pictureRatio = document.getElementById('pictureViewer').naturalWidth / document.getElementById('pictureViewer').clientWidth;
                        if (document.getElementById('pictureViewer').naturalWidth < 500 || document.getElementById('pictureViewer').naturalHeight < 500) {
                            $('#pictureViewer')
                                    .attr('src', '');

                            if (typeof JcropAPI != 'undefined')
                                JcropAPI.destroy();

                            initJcrop(pictureRatio);

                            alert('Picture must be at least 500x500 pixels!');

                        } else {

                            if (typeof JcropAPI != 'undefined')
                                JcropAPI.destroy();
                            initJcrop(pictureRatio);

                        }
                    });
                };

                reader.readAsDataURL(input.files[0]);
            }
        }


        function initJcrop(pictureRatio)
				{

					$('#pictureViewer').Jcrop({
                        setSelect: [0, 0, Math.round(500 / pictureRatio), Math.round(500 / pictureRatio)],
                        aspectRatio: 1,
                        minSize: [Math.round(500 / pictureRatio), Math.round(500 / pictureRatio)],
                        allowSelect: false,
                        boxWidth: 500,//document.getElementById('pictureViewer').clientWidth,
                        boxHeight: 500//document.getElementById('pictureViewer').clientHeight
                    },function(){

                        JcropAPI = this;
                        JcropAPI.animateTo([100,100,400,300]);

					});

                    $('#prout').mouseout(function() {
                        $('#cropx').val(Math.round(parseInt($('#pictureViewer').next().css('left')) * pictureRatio));
                        $('#cropy').val(Math.round(parseInt($('#pictureViewer').next().css('top')) * pictureRatio));
                        $('#cropw').val(Math.round(parseInt($('#pictureViewer').next().css('width')) * pictureRatio));
                        $('#croph').val(Math.round(parseInt($('#pictureViewer').next().css('height')) * pictureRatio));
                    });

				};

            /*$(document).on('cropstart cropmove cropend', '#pictureViewer', function(e,s,c){

                alert('ddqf');
                console.log(e,s,c);
                // @todo: do something useful with c
                // { x: 10, y: 10, x2: 30, y2: 30, w: 20, h: 20 }
                // c.x, c.y, c.w, c.h, ...
                // or access s.selectionApiMethod() or s.core.apiMethod() etc
                // compare event type with e.type (e.g. in if conditional, switch block)

            });*/

        /*$('#pictureViewer').on('cropmove cropend',function(e,s,c){
            alert(c.x);
            $('#cropx').val(c.x);
            $('#cropy').val(c.y);
            $('#cropw').val(c.w);
            $('#croph').val(c.h);
        });*/
    </script>
@endsection
