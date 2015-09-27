<div class="modal fade review-modal" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">

            <div class="modal-header"><!-- modal header -->
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title" id="myModalLabel">Write a review for your order:</h4>
            </div><!-- /modal header -->

            {!! Form::open(['url' => 'reviews']) !!}
            @include('reviews._form', ['submitButtonText' => 'Post Review'])
            {!! Form::close() !!}

            @include('errors.list')

        </div>
    </div>
</div>