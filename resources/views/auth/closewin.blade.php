<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>{{ config('app.name') }} | Registration Page</title>

    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">

    <!-- Bootstrap 3.3.7 -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">

    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

    <!-- Ionicons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ionicons/2.0.1/css/ionicons.min.css">

    <!-- Theme style -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/admin-lte/2.4.3/css/AdminLTE.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/admin-lte/2.4.3/css/skins/_all-skins.min.css">

    <!-- iCheck -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/iCheck/1.0.2/skins/square/_all.css">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>
<body class="hold-transition register-page">

<!-- /.register-box -->

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

<!-- AdminLTE App -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/admin-lte/2.4.3/js/adminlte.min.js"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/iCheck/1.0.2/icheck.min.js"></script>
<script src="https://static.line-scdn.net/liff/edge/versions/2.11.1/sdk.js"></script>
<script>
    $(function () {
        $('input').iCheck({
            checkboxClass: 'icheckbox_square-blue',
            radioClass: 'iradio_square-blue',
            increaseArea: '20%' // optional
        });
        // if ($( "#role_select" ).val() == "guest") {
        //     $( "#guest_area" ).show();
        //     $( "#store_area" ).hide();
        // }else if($( "#role_select" ).val() == "store"){
        //     $( "#guest_area" ).hide();
        //     $( "#store_area" ).show();
        // }
        // $('#role_select').on('change', function() {
        //     if ($( "#role_select" ).val() == "guest") {
        //         $( "#guest_area" ).show();
        //         $( "#store_area" ).hide();
        //     }else if($( "#role_select" ).val() == "store"){
        //         $( "#guest_area" ).hide();
        //         $( "#store_area" ).show();
        //     }
        // });

        //使用 LIFF_ID 初始化 LIFF 應用
        // initializeLiff('{{env('LINE_LIFF_ID')}}');

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
                console.log('啟動失敗。');
            });
    }

    function initializeApp() {
        liff.getProfile()
            .then(profile => {
                const line_uid = profile.userId
                $('#line_uid').val(line_uid);
            })
            .catch((err) => {
                console.log(err.message || err);
            });
    }

    // $('#registerForm').submit(function () {
    //     liff.closeWindow();
    // });
</script>
</body>
</html>
