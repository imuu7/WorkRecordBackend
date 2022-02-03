<div class="row">
<!-- Name Field -->
<div class="form-group col-sm-6">
    {!! Form::label('name', __('models/configTables.fields.name').':') !!}
    {!! Form::text('name', null, ['class' => 'form-control']) !!}
</div>

<!-- Val Field -->
<div class="form-group col-sm-12 col-lg-12">
    {!! Form::label('val', __('models/configTables.fields.val').':') !!}
    {!! Form::textarea('val', null, ['class' => 'form-control']) !!}
</div>

<!-- Submit Field -->
<div class="form-group col-sm-12">
    {!! Form::submit(__('crud.save'), ['class' => 'btn btn-primary']) !!}
    <a href="javascript:void(0)" onclick="ajaxCU.close()" class="btn btn-default">@lang('crud.cancel')</a>
</div>
</div>
