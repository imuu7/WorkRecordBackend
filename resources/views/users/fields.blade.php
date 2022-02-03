<div class="row">
<!-- Name Field -->
<div class="form-group col-sm-6">
    {!! Form::label('name', __('models/users.fields.name').':') !!}
    {!! Form::text('name', null, ['class' => 'form-control']) !!}
</div>

<!-- Email Field -->
<div class="form-group col-sm-6">
    {!! Form::label('email', __('models/users.fields.email').':') !!}
    {!! Form::email('email', null, ['class' => 'form-control']) !!}
</div>

<!-- Email Verified At Field -->
{{-- <div class="form-group col-sm-6">
    {!! Form::label('email_verified_at', __('models/users.fields.email_verified_at').':') !!}
    {!! Form::date('email_verified_at', null, ['class' => 'form-control','id'=>'email_verified_at']) !!}
</div> --}}

{!! Form::hidden('email_verified_at', null, ['class' => 'form-control','id'=>'email_verified_at']) !!}

@push('scripts')
    <script type="text/javascript">
        $('#email_verified_at').datetimepicker({
            format: 'YYYY-MM-DD HH:mm:ss',
            useCurrent: false
        })
    </script>
@endpush

<!-- Password Field -->
{{-- <div class="form-group col-sm-6">
    {!! Form::label('password', __('models/users.fields.password').':') !!}
    {!! Form::password('password', ['class' => 'form-control']) !!}
</div> --}}

{!! Form::hidden('password', null, ['class' => 'form-control']) !!}

<!-- Role Field -->
<div class="form-group col-sm-6">
    {!! Form::label('role', __('models/users.fields.role').':') !!}
    {!! Form::text('role', null, ['class' => 'form-control']) !!}
</div>

<!-- Remember Token Field -->
{{-- <div class="form-group col-sm-6">
    {!! Form::label('remember_token', __('models/users.fields.remember_token').':') !!}
    {!! Form::text('remember_token', null, ['class' => 'form-control']) !!}
</div> --}}

{!! Form::hidden('remember_token', null, ['class' => 'form-control']) !!}

<!-- Active Field -->
<div class="form-group col-sm-6">
    {!! Form::label('active', __('models/users.fields.active').':') !!}
    {!! Form::number('active', null, ['class' => 'form-control']) !!}
</div>

<!-- Stoken Field -->
{{-- <div class="form-group col-sm-6">
    {!! Form::label('stoken', __('models/users.fields.stoken').':') !!}
    {!! Form::text('stoken', null, ['class' => 'form-control']) !!}
</div> --}}

{!! Form::hidden('stoken', null, ['class' => 'form-control']) !!}

<!-- Submit Field -->
<div class="form-group col-sm-12">
    {!! Form::submit(__('crud.save'), ['class' => 'btn btn-primary']) !!}
    <a href="javascript:void(0)" onclick="ajaxCU.close()" class="btn btn-default">@lang('crud.cancel')</a>
</div>
</div>
