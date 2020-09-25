<!-- Id Field -->
<div class="form-group">
    {!! Form::label('id', __('models/accounts.fields.id').':') !!}
    <p>{{ $account->id }}</p>
</div>

<!-- Type Field -->
<div class="form-group">
    {!! Form::label('type', __('models/accounts.fields.type').':') !!}
    <p>{{ $account->type }}</p>
</div>

<!-- Amount Field -->
<div class="form-group">
    {!! Form::label('amount', __('models/accounts.fields.amount').':') !!}
    <p>{{ $account->amount }}</p>
</div>

<!-- Description Field -->
<div class="form-group">
    {!! Form::label('description', __('models/accounts.fields.description').':') !!}
    <p>{{ $account->description }}</p>
</div>

<!-- Created Date Field -->
<div class="form-group">
    {!! Form::label('created_date', __('models/accounts.fields.created_date').':') !!}
    <p>{{ $account->created_date }}</p>
</div>

<!-- Created At Field -->
<div class="form-group">
    {!! Form::label('created_at', __('models/accounts.fields.created_at').':') !!}
    <p>{{ $account->created_at }}</p>
</div>

<!-- Updated At Field -->
<div class="form-group">
    {!! Form::label('updated_at', __('models/accounts.fields.updated_at').':') !!}
    <p>{{ $account->updated_at }}</p>
</div>

