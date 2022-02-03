@extends('layouts.app')

@section('content')
    <div class="container-fluid container-fixed-lg">
        <h3 class="page-title">
            @lang('models/reservations.singular')
        </h3>
    </div>
    <div class="container-fluid container-fixed-lg">
        @include('adminlte-templates::common.errors')
        <div class="card card-transparent">
            <div class="card-body">
                <div class="row">
                    {!! Form::open(['route' => 'reservations.store']) !!}

                        @include('reservations.fields')

                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
<script src="https://static.line-scdn.net/liff/edge/versions/2.11.1/sdk.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.form/4.3.0/jquery.form.min.js" integrity="sha384-qlmct0AOBiA2VPZkMY3+2WqkHtIQ9lSdAsAn5RUJD/3vA5MKDgSGcdmIv4ycVxyn" crossorigin="anonymous"></script>
<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>    

    function initializeLiff(myLiffId) {
        liff
            .init({
                liffId: myLiffId
            })
            .then(() => {
                // initializeApp();
            })
            .catch((err) => { 
                console.log('啟動失敗。');
            });
    }

    function initializeApp() {
        // liff.getProfile()
        //     .then(profile => {
        //         const line_uid = profile.userId
        //         $('#line_uid').val(line_uid);
        //         // alert(line_uid)
        //     })
        //     .catch((err) => {
        //         console.log('error', err);
        //     });
    }

    $(document).ready(() => initializeLiff(
        "{{config('line.liff_recv_id')}}"
    ))

    // $('form').ajaxForm(() => {
    //     Swal.fire({
    //         title: '預約成功！',
    //         icon: 'success',
    //         confirmButtonText: 'OK'
    //     }).then(() => {
    //         liff.closeWindow();
    //     })
    // })


</script>
@endpush
