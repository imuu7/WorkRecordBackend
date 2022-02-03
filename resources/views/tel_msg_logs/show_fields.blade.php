<!-- Message Id Field -->
<div class="form-group col-12">
    {!! Form::label('message_id', __('models/telMsgLogs.fields.message_id').':') !!}
    <p>{{ $telMsgLog->message_id }}</p>
</div>


<!-- Msg From Id Field -->
<div class="form-group col-12">
    {!! Form::label('msg_from_id', __('models/telMsgLogs.fields.msg_from_id').':') !!}
    <p>{{ $telMsgLog->msg_from_id }}</p>
</div>


<!-- Msg From Body Field -->
<div class="form-group col-12">
    {!! Form::label('msg_from_body', __('models/telMsgLogs.fields.msg_from_body').':') !!}
    <p>{{ $telMsgLog->msg_from_body }}</p>
</div>


<!-- Message Date Field -->
<div class="form-group col-12">
    {!! Form::label('message_date', __('models/telMsgLogs.fields.message_date').':') !!}
    <p>{{ $telMsgLog->message_date }}</p>
</div>


<!-- Chat Body Field -->
<div class="form-group col-12">
    {!! Form::label('chat_body', __('models/telMsgLogs.fields.chat_body').':') !!}
    <p>{{ $telMsgLog->chat_body }}</p>
</div>


<!-- Chat Text Field -->
<div class="form-group col-12">
    {!! Form::label('chat_text', __('models/telMsgLogs.fields.chat_text').':') !!}
    <p>{{ $telMsgLog->chat_text }}</p>
</div>


