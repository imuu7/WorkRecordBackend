<!-- Name Field -->
<div class="form-group col-12">
    {!! Form::label('name', __('models/users.fields.name').':') !!}
    <p>{{ $users->name }}</p>
</div>


<!-- Email Field -->
<div class="form-group col-12">
    {!! Form::label('email', __('models/users.fields.email').':') !!}
    <p>{{ $users->email }}</p>
</div>


<!-- Email Verified At Field -->
<div class="form-group col-12">
    {!! Form::label('email_verified_at', __('models/users.fields.email_verified_at').':') !!}
    <p>{{ $users->email_verified_at }}</p>
</div>


<!-- Password Field -->
<div class="form-group col-12">
    {!! Form::label('password', __('models/users.fields.password').':') !!}
    <p>{{ $users->password }}</p>
</div>


<!-- Role Field -->
<div class="form-group col-12">
    {!! Form::label('role', __('models/users.fields.role').':') !!}
    <p>{{ $users->role }}</p>
</div>


<!-- Remember Token Field -->
<div class="form-group col-12">
    {!! Form::label('remember_token', __('models/users.fields.remember_token').':') !!}
    <p>{{ $users->remember_token }}</p>
</div>


<!-- Active Field -->
<div class="form-group col-12">
    {!! Form::label('active', __('models/users.fields.active').':') !!}
    <p>{{ $users->active }}</p>
</div>


<!-- Stoken Field -->
<div class="form-group col-12">
    {!! Form::label('stoken', __('models/users.fields.stoken').':') !!}
    <p>{{ $users->stoken }}</p>
</div>


