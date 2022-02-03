<div class="row">
<!-- Message Id Field -->
<div class="form-group col-sm-6">
    {!! Form::label('message_id', __('models/telMsgLogs.fields.message_id').':') !!}
    {!! Form::text('message_id', null, ['class' => 'form-control']) !!}
</div>

<!-- Msg From Id Field -->
<div class="form-group col-sm-6">
    {!! Form::label('msg_from_id', __('models/telMsgLogs.fields.msg_from_id').':') !!}
    {!! Form::number('msg_from_id', null, ['class' => 'form-control']) !!}
</div>

<!-- Msg From Body Field -->
<div class="form-group col-sm-12 col-lg-12">
    {!! Form::label('msg_from_body', __('models/telMsgLogs.fields.msg_from_body').':') !!}
    {!! Form::textarea('msg_from_body', null, ['class' => 'form-control']) !!}
</div>

<!-- Message Date Field -->
<div class="form-group col-sm-6">
    {!! Form::label('message_date', __('models/telMsgLogs.fields.message_date').':') !!}
    {!! Form::date('message_date', null, ['class' => 'form-control','id'=>'message_date']) !!}
</div>

@push('scripts')
    <script type="text/javascript">
        $('#message_date').datetimepicker({
            format: 'YYYY-MM-DD HH:mm:ss',
            useCurrent: false
        })
    </script>
@endpush

<!-- Chat Body Field -->
<div class="form-group col-sm-12 col-lg-12">
    {!! Form::label('chat_body', __('models/telMsgLogs.fields.chat_body').':') !!}
    {!! Form::textarea('chat_body', null, ['class' => 'form-control']) !!}
</div>

<!-- Chat Text Field -->
<div class="form-group col-sm-12 col-lg-12">
    {!! Form::label('chat_text', __('models/telMsgLogs.fields.chat_text').':') !!}
    {!! Form::textarea('chat_text', null, ['class' => 'form-control']) !!}
</div>

<!-- Submit Field -->
<div class="form-group col-sm-12">
    {!! Form::submit(__('crud.save'), ['class' => 'btn btn-primary']) !!}
    <a href="javascript:void(0)" onclick="ajaxCU.close()" class="btn btn-default">@lang('crud.cancel')</a>
</div>
</div>
