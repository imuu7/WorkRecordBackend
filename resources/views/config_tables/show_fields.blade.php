<!-- Name Field -->
<div class="form-group col-12">
    {!! Form::label('name', __('models/configTables.fields.name').':') !!}
    <p>{{ $configTable->name }}</p>
</div>


<!-- Val Field -->
<div class="form-group col-12">
    {!! Form::label('val', __('models/configTables.fields.val').':') !!}
    <p>{{ $configTable->val }}</p>
</div>


