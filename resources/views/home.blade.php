@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">

{{-- {{env("TELEGRAM_BOT_TOKEN","aa")}}
{{env("LINE_CHANNEL_SECRET","zz")}}
{{env('DB_CONNECTION',"dd")}}
{{Config::get('telegram.bots.mybot.token')}}
{{Config::get('telegram.bots.mybot.webhook_url')}} --}}

    </div>
</div>
@endsection
@push('scripts')
<script src="https://static.line-scdn.net/liff/edge/versions/2.11.1/sdk.js"></script>
<script>
    $(function () {
      

        initializeLiff('{{config('line.liff_id')}}');
    });

    function initializeLiff(myLiffId) {
        liff
            .init({
                liffId: myLiffId
            })
            .then(() => {
                // initializeApp();
                liff.closeWindow();
            })
            .catch((err) => {
                // alert('啟動失敗。');
            });
    }
</script>
@endpush