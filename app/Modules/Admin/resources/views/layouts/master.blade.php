<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- Main CSS-->
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/main.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/custom.css') }}">
    <!-- Font-icon css-->
    <link rel="stylesheet" type="text/css"
          href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link href="{{asset('assets/alertify/css/alertify.min.css')}}" id='aleritify_ds' rel="stylesheet">
    <link href="{{asset('assets/alertify/css/themes/bootstrap.min.css')}}" id='aleritify_s' rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/custom.css') }}">
    <title>{{ config('app.name', 'Laravel') }} - @yield('title')</title>

</head>
<body>
<section class="material-half-bg">
    <div class="cover"></div>
</section>

@section('header')
@show

@section('sidebar')
@show
<div id="ajax_loader"></div>
@yield('content')


<!-- Essential javascripts for application to work-->
<script src="{{ asset('assets/js/jquery-3.3.1.min.js') }}"></script>
<script src="{{ asset('assets/js/popper.min.js') }}"></script>
<script src="{{ asset('assets/js/bootstrap.min.js') }}"></script>
<script src="{{ asset('assets/js/main.js') }}"></script>
<!-- The javascript plugin to display page loading on top-->
<script src="{{ asset('assets/js/plugins/pace.min.js') }}"></script>
<script type="text/javascript">
    // Login Page Flipbox control
    $('.login-content [data-toggle="flip"]').click(function () {
        $('.login-box').toggleClass('flipped');
        return false;
    });
</script>

<script type="text/javascript" src="{{ asset('assets/js/plugins/jquery.dataTables.min.js')}}"></script>
<script type="text/javascript" src="{{ asset('assets/js/plugins/dataTables.bootstrap.min.js')}}"></script>
<script type="text/javascript" src="{{asset('assets/js/plugins/bootstrap-notify.min.js')}}"></script>
<script type="text/javascript" src="{{asset('assets/js/plugins/sweetalert.min.js')}}"></script>
<script type="text/javascript" src="{{asset('assets/js/plugins/bootstrap-datepicker.min.js')}}"></script>
<script type="text/javascript" src="{{asset('assets/js/plugins/select2.min.js')}}"></script>

<script>
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
</script>
<script src="{{asset('assets/js/notify.js')}}" type="text/javascript"></script>
<script src="{{asset('assets/js/datatables.js')}}" type="text/javascript"></script>
@stack('scripts')

</body>
</html>
