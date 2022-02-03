<!-- Name Field -->
<div class="form-group col-12">
    {!! Form::label('name', __('models/lineConfigs.fields.name').':') !!}
    <p>{{ $lineConfig->name }}</p>
</div>


<!-- Val Field -->
<div class="form-group col-12">
    {!! Form::label('val', __('models/lineConfigs.fields.val').':') !!}
    <p>{{ $lineConfig->val }}</p>
</div>


<!-- Nickname Field -->
<div class="form-group col-12">
    {!! Form::label('nickname', __('models/lineConfigs.fields.nickname').':') !!}
    <p>{{ $lineConfig->nickname }}</p>
</div>


<!-- Created At Field -->
<div class="form-group col-12">
    {!! Form::label('created_at', __('models/lineConfigs.fields.created_at').':') !!}
    <p>{{ $lineConfig->created_at }}</p>
</div>


<!-- Updated At Field -->
<div class="form-group col-12">
    {!! Form::label('updated_at', __('models/lineConfigs.fields.updated_at').':') !!}
    <p>{{ $lineConfig->updated_at }}</p>
</div>


