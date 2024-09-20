<!-- meta tags and other links -->
<!DOCTYPE html>
<html lang="en" data-theme="light">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Electromart | Dashboard</title>
    <link rel="icon" type="image/png" href="{{url('public/uploads/system/siteicon.png')}}" sizes="16x16">
    <!-- remix icon font css  -->
    <link rel="stylesheet" href="{{url('public/admin/assets/css/remixicon.css')}}">
    <!-- BootStrap css -->
    <link rel="stylesheet" href="{{url('public/admin/assets/css/lib/bootstrap.min.css')}}">
    <!-- Apex Chart css -->
    <link rel="stylesheet" href="{{url('public/admin/assets/css/lib/apexcharts.css')}}">
    <!-- Data Table css -->
    <link rel="stylesheet" href="{{url('public/admin/assets/css/lib/dataTables.min.css')}}">
    <!-- Text Editor css -->
    <link rel="stylesheet" href="{{url('public/admin/assets/css/lib/editor-katex.min.css')}}">
    <link rel="stylesheet" href="{{url('public/admin/assets/css/lib/editor.atom-one-dark.min.css')}}">
    <link rel="stylesheet" href="{{url('public/admin/assets/css/lib/editor.quill.snow.css')}}">
    <!-- Date picker css -->
    <link rel="stylesheet" href="{{url('public/admin/assets/css/lib/flatpickr.min.css')}}">
    <!-- Calendar css -->
    <link rel="stylesheet" href="{{url('public/admin/assets/css/lib/full-calendar.css')}}">
    <!-- Vector Map css -->
    <link rel="stylesheet" href="{{url('public/admin/assets/css/lib/jquery-jvectormap-2.0.5.css')}}">
    <!-- Popup css -->
    <link rel="stylesheet" href="{{url('public/admin/assets/css/lib/magnific-popup.css')}}">
    <!-- Slick Slider css -->
    <link rel="stylesheet" href="{{url('public/admin/assets/css/lib/slick.css')}}">
    <!-- main css -->
    <link rel="stylesheet" href="{{url('public/admin/assets/css/style.css')}}">
    <!-- sweetalert js link -->
    <script src="{{url('public/admin/assets/js/sweetalert.min.js')}}"></script>
    @stack('css')
</head>

<body>
    @include('adminpanel.layouts.partials.sidebar')

    <main class="dashboard-main">
        @include('adminpanel.layouts.partials.header')
        <div class="dashboard-main-body">
            @yield('content')
        </div>

        @include('adminpanel.layouts.partials.footer')
    </main>

    <!-- jQuery library js -->
    <script src="{{url('public/admin/assets/js/lib/jquery-3.7.1.min.js')}}"></script>
    <!-- Bootstrap js -->
    <script src="{{url('public/admin/assets/js/lib/bootstrap.bundle.min.js')}}"></script>
    <!-- Apex Chart js -->
    <script src="{{url('public/admin/assets/js/lib/apexcharts.min.js')}}"></script>
    <!-- Data Table js -->
    <script src="{{url('public/admin/assets/js/lib/dataTables.min.js')}}"></script>
    <!-- Iconify Font js -->
    <script src="{{url('public/admin/assets/js/lib/iconify-icon.min.js')}}"></script>
    <!-- jQuery UI js -->
    <script src="{{url('public/admin/assets/js/lib/jquery-ui.min.js')}}"></script>
    <!-- Vector Map js -->
    <script src="{{url('public/admin/assets/js/lib/jquery-jvectormap-2.0.5.min.js')}}"></script>
    <script src="{{url('public/admin/assets/js/lib/jquery-jvectormap-world-mill-en.js')}}"></script>
    <!-- Popup js -->
    <script src="{{url('public/admin/assets/js/lib/magnifc-popup.min.js')}}"></script>
    <!-- Slick Slider js -->
    <script src="{{url('public/admin/assets/js/lib/slick.min.js')}}"></script>
    <!-- main js -->
    <script src="{{url('public/admin/assets/js/app.js')}}"></script>
    <script src="{{url('public/admin/assets/js/lib/popper.min.js')}}"></script>

    <script src="{{url('public/admin/assets/js/homeThreeChart.js')}}"></script>
    @stack('js')
</body>

</html>