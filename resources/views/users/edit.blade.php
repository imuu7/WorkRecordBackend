@extends('layouts.app')

@section('content')
    <div class="container-fluid container-fixed-lg">
        <h3 class="page-title">
            @lang('models/users.singular')
        </h3>
    </div>
    <div class="container-fluid container-fixed-lg">
        @include('adminlte-templates::common.errors')
        <div class="card card-transparent">
            <div class="card-body">
                <div class="row">
                    {!! Form::model($users, ['route' => ['users.update', $users->id], 'method' => 'patch']) !!}

                            @include('users.fields')

                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
@endsection
