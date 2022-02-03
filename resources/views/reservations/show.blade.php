@extends('layouts.app')

@section('content')
    <div class="container-fluid   container-fixed-lg">
        <h3 class="page-title">
            @lang('models/reservations.singular')
        </h3>
    </div>
    <div class="container-fluid   container-fixed-lg">
        <div class="card card-transparent">
            <div class="card-body">
                <div class="row" style="padding-left: 20px">
                    @include('reservations.show_fields')
                    <a href="{{ route('reservations.index') }}" class="btn btn-default">
                        @lang('crud.back')
                    </a>
                </div>
            </div>
        </div>
    </div>
@endsection
