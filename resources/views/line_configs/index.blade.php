@extends('layouts.app')

@section('content')
    <div class="container-fluid container-fixed-lg">
        <h3 class="page-title">@lang('models/lineConfigs.plural')</h3>
        <a class="btn btn-primary pull-right" style="margin-top: -10px;margin-bottom: 5px;z-index: 100" href="{{ route('lineConfigs.create') }}">@lang('crud.add_new')</a>
    </div>
    <div class="container-fluid container-fixed-lg">
        <div class="clearfix"></div>

        @include('flash::message')

        <div class="clearfix"></div>
        <div class="box box-primary">
            <div class="box-body">
                    @include('line_configs.table')
            </div>
        </div>
        <div class="text-center">
        
        </div>
    </div>
@endsection

