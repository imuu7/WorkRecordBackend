@extends('layouts.app')
@section('css')
<style>
    #shadow-form {
        position: fixed;
        top: 0;
        left: 0;
        z-index: 1000;
        height: 100%;
        width: 100%;
        display: grid;
        place-items: center;
        background: rgba(0,0,0,.4)
    }
    #shadow-form form {
        max-width: 800px;
        width: 85vw;
        margin: 4rem 0;
        padding: 1.5rem;
        overflow: auto;
        background: #f6f9fa;
        border-radius: 16px;
    }
</style>
@endsection

@section('content')
    <div class="container-fluid container-fixed-lg">
        <h3 class="page-title">@lang('models/telMsgLogs.plural')</h3>
        <a class="btn btn-primary pull-right" style="margin-top: -10px;margin-bottom: 5px;z-index: 100" href="javascript:ajaxCU()">@lang('crud.add_new')</a>
    </div>
    <div class="container-fluid container-fixed-lg">
        <div class="clearfix"></div>

        @include('flash::message')

        <div class="clearfix"></div>
        <div class="box box-primary">
            <div class="box-body">
                    @include('tel_msg_logs.table')
            </div>
        </div>
        <div class="text-center">
        
        </div>
    </div>
    <div id="shadow-form" style="display: none">
        {!! Form::open(['route' => 'telMsgLogs.store', 'method' => 'PATCH']) !!}

            @include('tel_msg_logs.fields')

        {!! Form::close() !!}
    </div>
@endsection

@push('scripts')
{{-- <script src="http://malsup.github.com/jquery.form.js"></script> --}}
<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    function ajaxCU(fill) {
        const form = $('#shadow-form form')
        const method = $('#shadow-form [name="_method"]')
        if (fill) {
            Object.keys(fill).forEach(key => {
                const input = document.querySelector(`#shadow-form [name="${key}"]`)
                if (!input) return
                if (input.getAttribute('type') === 'checkbox') input.checked = fill[key] ? true : false
                else input.value = fill[key]
            })
            form.attr('action', '{{ route("telMsgLogs.store") }}/' + fill['id'])
            method.val('PATCH')
        } else {
            form.attr('action', '{{ route("telMsgLogs.store") }}')
            method.val('POST')
        }
        $('#shadow-form').show()
    }
    ajaxCU.close = () => {
        $('#shadow-form').hide()
    }
</script>
@endpush
