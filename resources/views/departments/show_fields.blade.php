<!-- Id Field -->
<div class="form-group">
    {!! Form::label('id', __('models/departments.fields.id').':') !!}
    <p>{{ $department->id }}</p>
</div>

<!-- Name Field -->
<div class="form-group">
    {!! Form::label('name', __('models/departments.fields.name').':') !!}
    <p>{{ $department->name }}</p>
</div>

<!-- Description Field -->
<div class="form-group">
    {!! Form::label('description', __('models/departments.fields.description').':') !!}
    <p>{{ $department->description }}</p>
</div>

<!-- Created At Field -->
<div class="form-group">
    {!! Form::label('created_at', __('models/departments.fields.created_at').':') !!}
    <p>{{ $department->created_at }}</p>
</div>

<!-- Updated At Field -->
<div class="form-group">
    {!! Form::label('updated_at', __('models/departments.fields.updated_at').':') !!}
    <p>{{ $department->updated_at }}</p>
</div>

