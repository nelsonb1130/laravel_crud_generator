<!-- Id Field -->
<div class="form-group">
    {!! Form::label('id', __('models/contacts.fields.id').':') !!}
    <p>{{ $contacts->id }}</p>
</div>

<!-- Title Field -->
<div class="form-group">
    {!! Form::label('title', __('models/contacts.fields.title').':') !!}
    <p>{{ $contacts->title }}</p>
</div>

<!-- First Name Field -->
<div class="form-group">
    {!! Form::label('first_name', __('models/contacts.fields.first_name').':') !!}
    <p>{{ $contacts->first_name }}</p>
</div>

<!-- Sur Name Field -->
<div class="form-group">
    {!! Form::label('sur_name', __('models/contacts.fields.sur_name').':') !!}
    <p>{{ $contacts->sur_name }}</p>
</div>

<!-- Description Field -->
<div class="form-group">
    {!! Form::label('description', __('models/contacts.fields.description').':') !!}
    <p>{{ $contacts->description }}</p>
</div>

<!-- Created At Field -->
<div class="form-group">
    {!! Form::label('created_at', __('models/contacts.fields.created_at').':') !!}
    <p>{{ $contacts->created_at }}</p>
</div>

<!-- Updated At Field -->
<div class="form-group">
    {!! Form::label('updated_at', __('models/contacts.fields.updated_at').':') !!}
    <p>{{ $contacts->updated_at }}</p>
</div>

