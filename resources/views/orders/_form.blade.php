<!-- modal body -->

<!--<div class="modal-body container-fluid">-->

    <div class="col-md-12">

        <!-- Date Form Input -->

        <div class="row">
            <div class='input-group date center-block' id='datetimepicker'>
                <div class="form-group">
                    {!! Form::label('datetime', trans('strings.order2')) !!}
                    {!! Form::text('served_at', null, ['class' => 'form-control']) !!}
                    <span class="input-group-addon">
                        <span class="glyphicon glyphicon-calendar"></span>
                    </span>
                </div>
            </div>
        </div>

        <!-- Type Form Input -->

        <div class="row">
            <div class="form-group center-block">
                {!! Form::label('type', trans('strings.order3')) !!}
                <div class="radio radio-primary">
                    <label>
                {!! Form::radio('type_id', 1, ['class' => 'radio radio-success']) !!} {{ trans('strings.order4') }}
                    </label>
                </div>
                <div class="radio radio-primary"><label>
                {!! Form::radio('type_id', 2, ['class' => 'radio radio-success']) !!} {{ trans('strings.order5') }}
                    </label> </div>
                    <div class="radio radio-primary"><label>
                {!! Form::radio('type_id', 3, ['class' => 'radio radio-success']) !!} {{ trans('strings.order6') }}
                        </label> </div>
                        <div class="radio radio-primary"><label>
                {!! Form::radio('type_id', 4, ['class' => 'radio radio-success']) !!} {{ trans('strings.order7') }}
                            </label> </div>
            </div>
        </div>

        <!-- Comment Form Input -->

        <div class="row">
            <div class="form-group">
                {!! Form::label('comment', trans('strings.order8')) !!}
                {!! Form::textarea('comment', null, ['class' => 'form-control']) !!}
            </div>
        </div>

    </div>

</div>

<!-- Add/Edit Order Form Input -->

<!--<div class="modal-footer">--><!-- modal footer -->
    <button class="btn btn-default">{{ trans('strings.order9') }}</button> <!--data-dismiss="modal"-->
    {!! Form::submit($submitButtonText, ['class' => 'btn btn-primary form control']) !!}
<!--</div>--><!-- /modal footer -->