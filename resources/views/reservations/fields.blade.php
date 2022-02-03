<div class="row">
<!-- Name Field -->
<div class="form-group col-sm-6">
    {!! Form::label('name', __('models/reservations.fields.name').':') !!}
    {!! Form::text('name', isset($name) ? $name : null, ['class' => 'form-control']) !!}
</div>

<!-- Reserve Time Field -->
<div class="form-group col-sm-6">
    {!! Form::label('reserve_time', __('models/reservations.fields.reserve_time').':') !!}
    {!! Form::date('reserve_time_date', null, ['class' => 'form-control','id'=>'reserve_time_date']) !!}
    {!! Form::time('reserve_time_time', null, ['class' => 'form-control','id'=>'reserve_time_time']) !!}
    {!! Form::hidden('reserve_time', null, ['class' => 'form-control','id'=>'reserve_time']) !!}
</div>

@push('scripts')
<script>
    $('#reserve_time_date, #reserve_time_time').on('change', () => {
        if ($('#reserve_time_date').val() && $('#reserve_time_time').val())
            $('#reserve_time').val($('#reserve_time_date').val() + ' ' + $('#reserve_time_time').val())
    })
</script>
@endpush

<!-- Reserve Items Field -->
<div class="form-group col-sm-6">
    {!! Form::label('reserve_items', __('models/reservations.fields.reserve_items').':') !!}
    {!! Form::text('reserve_items', null, ['class' => 'form-control']) !!}
</div>

<!-- Phone Field -->
<div class="form-group col-sm-6">
    {!! Form::label('phone', __('models/reservations.fields.phone').':') !!}
    {!! Form::text('phone', null, ['class' => 'form-control']) !!}
</div>

<!-- Note Field -->
<div class="form-group col-sm-12 col-lg-12">
    {!! Form::label('note', __('models/reservations.fields.note').':') !!}
    {!! Form::textarea('note', null, ['class' => 'form-control']) !!}
</div>

<!-- Submit Field -->
<div class="form-group col-sm-12">
    {!! Form::submit(__('crud.save'), ['class' => 'btn btn-primary']) !!}
    <a href="javascript:void(0)" onclick="ajaxCU.close()" class="btn btn-default">@lang('crud.cancel')</a>
</div>
</div>

