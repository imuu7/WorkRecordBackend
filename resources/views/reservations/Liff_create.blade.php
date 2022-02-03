@extends('layouts.LIFF_app')

<style>
    
    .blur {
        filter: blur(4px);
    }

</style>
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
                
                    {!! Form::open(['route' => 'reservations.store','id'=>'maintable']) !!}

                        @include('reservations.fields')

                    {!! Form::close() !!}
            </div>
        </div>
    </div>
@endsection

@push('scripts')
<script src="https://static.line-scdn.net/liff/edge/versions/2.11.1/sdk.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.form/4.3.0/jquery.form.min.js" integrity="sha384-qlmct0AOBiA2VPZkMY3+2WqkHtIQ9lSdAsAn5RUJD/3vA5MKDgSGcdmIv4ycVxyn" crossorigin="anonymous"></script>
<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    function init_input(){
        
        $("#reserve_items").val("測試商品")
        $("#phone").val("09123456789")
    }
// this is the id of the form
$("#maintable").submit(function(e) {

var form = $(this);
var url = form.attr('action');
$("#maintable").addClass("blur")
$.ajax({
       type: "POST",
       url: url,
       data: form.serialize(), // serializes the form's elements.
       success: function(data)
       {
        Swal.fire({
            title: '預約成功！',
            icon: 'success',
            confirmButtonText: 'OK'
        }).then(() => {
            liff.sendMessages("收到您的預約!!　請您到下面的後台網址進行查詢記錄")
            liff.sendMessages("{{Config::get('app.url')}}")
            liff.sendMessages("帳號：admin@gmail.com")
            liff.sendMessages("密碼：Aa326598")
            liff.closeWindow();
        })
       }
     });

e.preventDefault(); // avoid to execute the actual submit of the form.
});

    function initializeLiff(myLiffId) {
        liff
            .init({
                liffId: myLiffId
            })
            .then(() => {
                initializeApp();
                init_input();
            })
            .catch((err) => {
                console.log('啟動失敗。');
            });
    }

    function initializeApp() {
        liff.getProfile()
            .then(profile => {
                const line_uid = profile.userId
                $('#line_uid').val(line_uid);
                // alert(line_uid)
            })
            .catch((err) => {
                console.log('error', err);
            });
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
