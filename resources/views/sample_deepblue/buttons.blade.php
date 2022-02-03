@extends('layouts.app_deep_blue')
{{-- @section('css')
<style>
</style>
@endsection --}}

@section('content')
    {{-- <div class="container-fluid container-fixed-lg">
        <h3 class="page-title">測試頁面</h3>
        <a class="btn btn-primary pull-right" style="margin-top: -10px;margin-bottom: 5px;z-index: 100" href="javascript:ajaxCU()">@lang('crud.add_new')</a>
    </div> --}}
    <div class="container-fluid container-fixed-lg">
        <div class="clearfix"></div>

        @include('flash::message')

        <div class="clearfix"></div>
        <div class="box box-primary">
            <div class="box-body">
                <div class="col-md-12">
                    <h3 class="page-title">地址查詢</h3>
                </div>
                <div class="col-md-4" >
                    <h5 style="display: inline; margin-right: 15px;">縣市</h5>
                    <select class=" select_1 btn3d btn btn-primary" aria-label="Default select example" style="display: inline; width: 60%;">
                        <option selected>台北市</option>
                        <option value="1">One</option>
                        <option value="2">Two</option>
                        <option value="3">Three</option>
                    </select>
                </div>

                <div class="col-md-12" style="margin-top: 30px;">
                    <h3 class="page-title">地址篩選</h3>
                </div>
                
                <div class="col-md-4" >
                    <h5>所有權人數</h5>
                    <input class="input_1 btn btn-primary" type="text">
                </div>
            </div>
        </div>
        <div class="text-center">
        
        </div>
    </div>
@endsection

@push('scripts')
{{-- <script src="http://malsup.github.com/jquery.form.js"></script> --}}
<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
{{-- <script>
</script> --}}
@endpush
