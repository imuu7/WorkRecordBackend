<div class="row">
<!-- Name Field -->
<div class="form-group col-sm-6">
    {!! Form::label('name', __('models/lineConfigs.fields.name').':') !!}
    {!! Form::text('name', null, ['class' => 'form-control']) !!}
</div>

<!-- Val Field -->
<div class="form-group col-sm-6">
    {!! Form::label('val', __('models/lineConfigs.fields.val').':') !!}
    {!! Form::text('val', null, ['class' => 'form-control']) !!}
</div>

<!-- Nickname Field -->
<div class="form-group col-sm-6">
    {!! Form::label('nickname', __('models/lineConfigs.fields.nickname').':') !!}
    {!! Form::text('nickname', null, ['class' => 'form-control']) !!}
</div>

<!-- Submit Field -->
<div class="form-group col-sm-12">
    {!! Form::submit(__('crud.save'), ['class' => 'btn btn-primary']) !!}
    <a href="{{ route('lineConfigs.index') }}" class="btn btn-default">@lang('crud.cancel')</a>
</div>
</div>
