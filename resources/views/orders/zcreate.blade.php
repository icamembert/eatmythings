<div class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">

            <div class="modal-header"><!-- modal header -->
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title" id="myModalLabel">Please provide some information about your order:</h4>
            </div><!-- /modal header -->

            {!! Form::open(['url' => 'orders']) !!}
                @include('orders._form', ['submitButtonText' => 'Place Order'])
            {!! Form::close() !!}

            @include('errors.list')

        </div>
    </div>
</div>