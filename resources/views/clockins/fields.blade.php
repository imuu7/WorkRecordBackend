<div class="row">
<!-- Date Field -->
<div class="form-group col-sm-6">
    {!! Form::label('date', __('models/clockins.fields.date').':') !!}
    {!! Form::text('date', null, ['class' => 'form-control']) !!}
</div>

<!-- Type Field -->
<div class="form-group col-sm-6">
    {!! Form::label('type', __('models/clockins.fields.type').':') !!}
    {!! Form::text('type', null, ['class' => 'form-control']) !!}
</div>

<!-- Name Field -->
<div class="form-group col-sm-6">
    {!! Form::label('name', __('models/clockins.fields.name').':') !!}
    {!! Form::text('name', null, ['class' => 'form-control']) !!}
</div>

<!-- User Id Field -->
<div class="form-group col-sm-6">
    {!! Form::label('user_id', __('models/clockins.fields.user_id').':') !!}
    {!! Form::number('user_id', null, ['class' => 'form-control']) !!}
</div>

<!-- Start Time Field -->
<div class="form-group col-sm-6">
    {!! Form::label('start_time', __('models/clockins.fields.start_time').':') !!}
    {!! Form::date('start_time', null, ['class' => 'form-control','id'=>'start_time']) !!}
</div>

@push('scripts')
    <script type="text/javascript">
        $('#start_time').datetimepicker({
            format: 'YYYY-MM-DD HH:mm:ss',
            useCurrent: false
        })
    </script>
@endpush

<!-- End Time Field -->
<div class="form-group col-sm-6">
    {!! Form::label('end_time', __('models/clockins.fields.end_time').':') !!}
    {!! Form::date('end_time', null, ['class' => 'form-control','id'=>'end_time']) !!}
</div>

@push('scripts')
    <script type="text/javascript">
        $('#end_time').datetimepicker({
            format: 'YYYY-MM-DD HH:mm:ss',
            useCurrent: false
        })
    </script>
@endpush

<!-- Over Time Field -->
<div class="form-group col-sm-6">
    {!! Form::label('over_time', __('models/clockins.fields.over_time').':') !!}
    {!! Form::text('over_time', null, ['class' => 'form-control']) !!}
</div>

<!-- Late Time Field -->
<div class="form-group col-sm-6">
    {!! Form::label('late_time', __('models/clockins.fields.late_time').':') !!}
    {!! Form::text('late_time', null, ['class' => 'form-control']) !!}
</div>

<!-- Leave Early Time Field -->
<div class="form-group col-sm-6">
    {!! Form::label('leave_early_time', __('models/clockins.fields.leave_early_time').':') !!}
    {!! Form::text('leave_early_time', null, ['class' => 'form-control']) !!}
</div>

<!-- Total Field -->
<div class="form-group col-sm-6">
    {!! Form::label('total', __('models/clockins.fields.total').':') !!}
    {!! Form::text('total', null, ['class' => 'form-control']) !!}
</div>

<!-- Verify Field -->
<div class="form-group col-sm-6">
    {!! Form::label('verify', __('models/clockins.fields.verify').':') !!}
    {!! Form::text('verify', null, ['class' => 'form-control']) !!}
</div>

<!-- Note Field -->
<div class="form-group col-sm-12 col-lg-12">
    {!! Form::label('note', __('models/clockins.fields.note').':') !!}
    {!! Form::textarea('note', null, ['class' => 'form-control']) !!}
</div>

<!-- Submit Field -->
<div class="form-group col-sm-12">
    {!! Form::submit(__('crud.save'), ['class' => 'btn btn-primary']) !!}
    <a href="javascript:void(0)" onclick="ajaxCU.close()" class="btn btn-default">@lang('crud.cancel')</a>
</div>
</div>
