<!-- Type Field -->
<div class="form-group col-sm-3">
    {!! Form::label('type', __('models/accounts.fields.type').':') !!}
    <br>
    <label class="checkbox-inline">
        {!! Form::radio('type', 'income', true) !!} Income &nbsp; &nbsp; &nbsp;
        {!! Form::radio('type', 'expense', null) !!} Expense
    </label>
</div>

<!-- Amount Field -->
<div class="form-group col-sm-3">
    {!! Form::label('amount', __('models/accounts.fields.amount').':') !!}
    {!! Form::number('amount', null, ['class' => 'form-control']) !!}
</div>
<!-- Created Date Field -->
<div class="form-group col-sm-3">
    {!! Form::label('created_date', __('models/accounts.fields.created_date').':') !!}
    {!! Form::text('created_date', null, ['class' => 'form-control','id'=>'created_date']) !!}
</div>
<!-- Description Field -->
<div class="form-group col-sm-6 col-lg-6">
    {!! Form::label('description', __('models/accounts.fields.description').':') !!}
    {!! Form::textarea('description', null, ['class' => 'form-control','placeholder'=>'Tax area description....','rows' => 2]) !!}
</div>  
   {!! Form::hidden('user_id',Auth::user()->id) !!}



@push('scripts')
    <script type="text/javascript">
        $('#created_date').datetimepicker({
            format: 'YYYY-MM-DD HH:mm:ss',
            useCurrent: true
        })
    </script>
@endpush

<!-- Submit Field -->
<div class="form-group col-sm-12">
    {!! Form::submit(__('crud.save'), ['class' => 'btn btn-primary']) !!}
    <a href="{{ route('admin.accounts.index') }}" class="btn btn-default">@lang('crud.cancel')</a>
</div>
