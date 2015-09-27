<!-- modal body -->

<div class="modal-body container-fluid">

    <div class="col-md-12">

        <!-- Title Form Input -->

        <div class="row">
            <div class="form-group">
                {!! Form::label('title', 'Title:') !!}
                {!! Form::text('title', null, ['class' => 'form-control']) !!}
            </div>
        </div>

        <!-- Body Form Input -->

        <div class="row">
            <div class="form-group">
                {!! Form::label('body', 'Body:') !!}
                {!! Form::textarea('body', null, ['class' => 'form-control']) !!}
            </div>
        </div>

        <!-- Chef Rating Form Input -->

        <div class="row">
            <div class="form-group center-block">
                {!! Form::label('chef_rating', 'Chef Rating:') !!}
                {!! Form::input('hidden', 'chef_rating', null, ['class' => 'form-control rating']) !!}
            </div>
        </div>

        <!-- Dish Rating Form Input -->

        <div class="row">
            <div class="form-group center-block">
                {!! Form::label('dish_rating', 'Dish Rating:') !!}
                
                @foreach($user->orders as $order)
                    <div id="order{{ $order->id }}" style="display: none;">
                        @foreach ($order->dishes as $dishToRate)
                            <div class="col-sm-6 col-md-3">
                                <div class="item-box fixed-box">
                                    <h5 class="text-center">{{ $dishToRate->name }}</h5>
                                    <a href="{{ action('DishesController@show', array('dishes' => $dishToRate, 'isBeingOrdered' => 0)) }}" class="thumbnail">
                                        <img class="img-responsive center-block" src="{{ asset('/userdata/' . $dishToRate->user_id . '/dishes/' . $dishToRate->id . '/picture_sm.jpg') }}" alt="Dish Picture" width="130" height="130" />
                                    </a>
                                    {!! Form::input('hidden', 'dish_rating_' . $dishToRate->id, null, ['class' => 'form-control rating text-center', 'data-filled' => 'glyphicon glyphicon-heart', 'data-empty' => 'glyphicon glyphicon-heart-empty']) !!}
                                </div>
                            </div>                                                                          
                        @endforeach
                    </div>
                @endforeach

            </div>
        </div>

        <input id="orderId" name="order_id" type="hidden" value="" />

    </div>

</div>

<!-- Add/Edit Order Form Input -->

<div class="modal-footer"><!-- modal footer -->
    <button class="btn btn-default" data-dismiss="modal">Cancel</button>
    {!! Form::submit($submitButtonText, ['class' => 'btn btn-primary form control']) !!}
</div><!-- /modal footer -->