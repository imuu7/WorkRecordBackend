@extends('layouts.app')

@section('content')
    <div class="container-fluid   container-fixed-lg">
        <h3 class="page-title">
            @lang('models/users.singular')
        </h3>
    </div>
    <div class="container-fluid   container-fixed-lg">
        <div class="card card-transparent">
            <div class="card-body">
                <div class="row" style="padding-left: 20px">
                    @include('users.show_fields')
                    <a href="{{ route('users.index') }}" class="btn btn-default">
                        @lang('crud.back')
                    </a>
                </div>
            </div>
        </div>
    </div>
@endsection
