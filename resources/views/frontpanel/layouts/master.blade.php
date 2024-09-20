<!doctype html>
<html class="no-js" lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>@yield('title') | {{ config('app.name', 'ElectroMart') }}</title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Favicon -->
    <link rel="shortcut icon" type="image/x-icon" href="{{url('public/uploads/system/siteicon.png')}}">

    <!-- CSS
	============================================ -->

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="{{url('public/front/assets/css/bootstrap.min.css')}}">

    <!-- Icon Font CSS -->
    <link rel="stylesheet" href="{{url('public/front/assets/css/icon-font.min.css')}}">

    <!-- Plugins CSS -->
    <link rel="stylesheet" href="{{url('public/front/assets/css/plugins.css')}}">

    <!-- Main Style CSS -->
    <link rel="stylesheet" href="{{url('public/front/assets/css/style.css')}}">
    @stack('css')
    <!-- Modernizer JS -->
    <script src="{{url('public/front/assets/js/vendor/modernizr-2.8.3.min.js')}}"></script>
</head>

<body>

    <!-- Header Section Start -->
    @include('frontpanel.layouts.partials.header')

    <!-- Feature Product Section Start -->
    @yield('content')
    <!-- Feature Product Section End -->

    <!-- Footer Section Start -->
    @include('frontpanel.layouts.partials.footer')
    <!-- Footer Section End -->
    <!-- JS
============================================ -->

    <!-- jQuery JS -->
    <script src="{{url('public/front/assets/js/vendor/jquery-1.12.4.min.js')}}"></script>
    <!-- Popper JS -->
    <script src="{{url('public/front/assets/js/popper.min.js')}}"></script>
    <!-- Bootstrap JS -->
    <script src="{{url('public/front/assets/js/bootstrap.min.js')}}"></script>
    <!-- Plugins JS -->
    <script src="{{url('public/front/assets/js/plugins.js')}}"></script>
    <!-- Ajax Mail -->
    <script src="{{url('public/front/assets/js/ajax-mail.js')}}"></script>
    <!-- Main JS -->
    <script src="{{url('public/front/assets/js/main.js')}}"></script>
    @stack('js')
</body>

</html>