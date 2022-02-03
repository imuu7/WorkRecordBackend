<!-- Name Field -->
<div class="form-group col-12">
    {!! Form::label('name', __('models/reservations.fields.name').':') !!}
    <p>{{ $reservation->name }}</p>
</div>


<!-- Reserve Time Field -->
<div class="form-group col-12">
    {!! Form::label('reserve_time', __('models/reservations.fields.reserve_time').':') !!}
    <p>{{ $reservation->reserve_time }}</p>
</div>


<!-- Reserve Items Field -->
<div class="form-group col-12">
    {!! Form::label('reserve_items', __('models/reservations.fields.reserve_items').':') !!}
    <p>{{ $reservation->reserve_items }}</p>
</div>


<!-- Phone Field -->
<div class="form-group col-12">
    {!! Form::label('phone', __('models/reservations.fields.phone').':') !!}
    <p>{{ $reservation->phone }}</p>
</div>


<!-- Note Field -->
<div class="form-group col-12">
    {!! Form::label('note', __('models/reservations.fields.note').':') !!}
    <p>{{ $reservation->note }}</p>
</div>


<!-- Created At Field -->
<div class="form-group col-12">
    {!! Form::label('created_at', __('models/reservations.fields.created_at').':') !!}
    <p>{{ $reservation->created_at }}</p>
</div>


<!-- Updated At Field -->
<div class="form-group col-12">
    {!! Form::label('updated_at', __('models/reservations.fields.updated_at').':') !!}
    <p>{{ $reservation->updated_at }}</p>
</div>


