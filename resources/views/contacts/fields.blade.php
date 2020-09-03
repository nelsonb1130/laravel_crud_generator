<!-- Title Field -->
<div class="form-group col-sm-6">
    {!! Form::label('title', __('models/contacts.fields.title').':') !!}
    {!! Form::text('title', null, ['class' => 'form-control']) !!}
</div>

<!-- First Name Field -->
<div class="form-group col-sm-6">
    {!! Form::label('first_name', __('models/contacts.fields.first_name').':') !!}
    {!! Form::text('first_name', null, ['class' => 'form-control']) !!}
</div>

<!-- Sur Name Field -->
<div class="form-group col-sm-6">
    {!! Form::label('sur_name', __('models/contacts.fields.sur_name').':') !!}
    {!! Form::text('sur_name', null, ['class' => 'form-control']) !!}
</div>

<!-- Description Field -->
<div class="form-group col-sm-12 col-lg-12">
    {!! Form::label('description', __('models/contacts.fields.description').':') !!}
    {!! Form::textarea('description', null, ['class' => 'form-control']) !!}
</div>

<!-- Submit Field -->
<div class="form-group col-sm-12">
    {!! Form::submit(__('crud.save'), ['class' => 'btn btn-primary']) !!}
    <a href="{{ route('contacts.index') }}" class="btn btn-default">@lang('crud.cancel')</a>
</div>
