<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" href="{{asset(setting('favicon'))}}">

    <!-- for Google Search -->
    @if(View::hasSection('description'))
        @yield('description')
    @else
{{--        <meta property="og:country-name" content="Saudi Arabia"/>--}}
{{--        <meta name="theme-color" content="#2375c0"/>--}}
{{--        <meta property="og:description" content=""/>--}}
{{--        <meta property="og:title" content=""/>--}}
{{--        <meta name="apple-mobile-web-app-capable" content="yes"/>--}}
{{--        <meta name="format-detection" content="telephone=yes"/>--}}
{{--        <meta property="og:site_name" content=""/>--}}
{{--        <meta name="keywords" content="">--}}
{{--        <meta name="description" content=""/>--}}
{{--        <meta property="og:image" content=""/>--}}
{{--        <meta property="twitter:image:media" content=""/>--}}
    @endif



    <title>{{setting('app_name',locale())}}</title>
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <!-- CSS Files -->
    <!-- Bootstrap -->
    <link rel="stylesheet" href="{{asset('frontend/assets/css/bootstrap.min.css')}}" />
    <link rel="stylesheet" href="{{asset('frontend/assets/css/fontawesome.min.css')}}">
    <link rel="stylesheet" href="{{asset('frontend/assets/font/icons/bootstrap-icons.css')}}" />
    <!-- Magnific Popup -->
    <link rel="stylesheet" href="{{asset('frontend/assets/css/magnific-popup.css')}}" />
    <!-- owl carousel -->
    <link rel="stylesheet" href="{{asset('frontend/assets/css/owl.carousel.min.css')}}" />
    <link rel="stylesheet" href="{{asset('frontend/assets/css/owl.theme.default.min.css')}}" />

    <link rel="stylesheet" href="{{asset('frontend/assets/css/venobox.min.css')}}">
    <link rel="stylesheet" href="{{asset('frontend/assets/font/flaticon/flaticon.css')}}">
    <link rel="stylesheet" href="{{asset('frontend/assets/css/themify-icons.css')}}">
    <link rel="stylesheet" href="{{asset('frontend/assets/css/all.min.css')}}">
    <link rel="stylesheet" href="{{asset('frontend/assets/css/date-picker.css')}}">
    <link rel="stylesheet" href="{{asset('frontend/assets/css/style-'.locale().'.css')}}" />
    <link rel="stylesheet" href="{{asset('frontend/assets/css/responsive-'.locale().'.css')}}" />

    @if(isset($styles) && count($styles))
        @foreach($styles as $style)
            <link rel="stylesheet" href="{{asset('frontend/assets/css/'.$style.'.css')}}">
        @endforeach
    @endif

    <link rel="stylesheet" href="{{asset('frontend/assets/css/custom-'.locale().'.css')}}" />

    <style>
        .grid-item .card{
            overflow: hidden;
        }
        .out_of_stock{
            color: #FFF;
            background: #c20732;
            width: fit-content;
            padding: 0 25px;
            position: absolute;
            @if(locale() == 'ar')
            right: -25px;
            -webkit-transform: rotateZ(45deg);
            -moz-transform: rotateZ(45deg);
            -o-transform: rotateZ(45deg);
            transform: rotateZ(45deg);
            @else
            left: -25px;
            -webkit-transform: rotateZ(-45deg);
            -moz-transform: rotateZ(-45deg);
            -o-transform: rotateZ(-45deg);
            transform: rotateZ(-45deg);
            @endif
            top: 20px;
            font-size: 12px;
        }
        .owl-carousel{
            direction: ltr !important;
        }
        .grid nav[role="navigation"]{
            display: block !important;
            position: absolute;
            bottom: -25px;
            @if(locale() == 'ar')
            right: 30px
            @else
            left: 30px
        @endif
}
        .grid nav[role="navigation"] .flex-1{
            display: none !important;
        }
    </style>

    @stack('css')
</head>

<body>
<!--
<div id="preloader">
    <div id="preloader-circle">
        <span></span>
        <span></span>
    </div>
</div>-->
