@extends('layouts.app')

@section('content')
    <div class="container-fluid container-fixed-lg">
        <h3 class="page-title">
            @lang('models/configTables.singular')
        </h3>
    </div>
    <div class="container-fluid container-fixed-lg">
        @include('adminlte-templates::common.errors')
        <div class="card card-transparent">
            <div class="card-body">
                <div class="row">
                    {!! Form::open(['route' => 'configTables.store']) !!}

                        @include('config_tables.fields')

                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
@endsection
