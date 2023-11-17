<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>@yield('title')-{{ config('app.name', 'Laravel') }}</title>

        <!-- Font -->

        <link href="https://fonts.googleapis.com/css?family=Roboto:300,400,500" rel="stylesheet">


        <!-- Stylesheets -->

        <link href="{{asset('frontend/css/bootstrap.css')}}" rel="stylesheet">

        <link href="{{asset('frontend/css/swiper.css')}}" rel="stylesheet">

        <link href="{{asset('frontend/css/ionicons.css')}}" rel="stylesheet">
        <!-- toastr Css-->
        <link rel="stylesheet" href="http://cdn.bootcss.com/toastr.js/latest/css/toastr.min.css">

        @stack('css')
    </head>
    <body class="font-sans antialiased">
        @include('layouts.frontend.partials.header')

        @yield('content')

        @include('layouts.frontend.partials.footer')

        <!-- SCRIPTS -->
        <script src="common-js/jquery-3.1.1.min.js{{asset('frontend/js/jquery-3.1.1.min.js')}}"></script>
        <script src="common-js/tether.min.js{{asset('frontend/js/tether.min.js')}}"></script>
        <script src="common-js/bootstrap.js{{asset('frontend/js/bootstrap.js')}}"></script>
        <script src="common-js/scripts.js{{asset('frontend/js/scripts.js')}}"></script>
        <script src="http://cdn.bootcss.com/toastr.js/latest/js/toastr.min.js"></script>
        {!! Toastr::message() !!}
        @stack('js')
    </body>
</html>
