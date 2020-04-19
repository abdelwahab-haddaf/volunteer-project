<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="utf-8" />
    <link rel="apple-touch-icon" sizes="76x76" href="{{asset('admin/img/apple-icon.png')}}">
    <link rel="icon" type="image/png" href="{{asset('admin/img/favicon.png')}}">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
    <title>
        @yield('title')
    </title>

{{--    <!--     Fonts and icons     -->--}}
{{--    <link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700|Roboto+Slab:400,700|Material+Icons" />--}}
{{--    --}}{{--    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/latest/css/font-awesome.min.css">--}}
{{--    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">--}}
{{--    <!-- Markazi Text font include just for persian demo purpose, don't include it in your project -->--}}
{{--    <link href="https://fonts.googleapis.com/css?family=Cairo&amp;subset=arabic" rel="stylesheet">--}}
    <!-- CSS Files -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{asset('admin/css/material-dashboard-rtl.css')}}" rel="stylesheet" />

    <!-- Noty plugins -->
    <link href="{{asset('admin/plugins/noty/noty.css')}}" rel="stylesheet" />
    <link href="{{asset('admin/plugins/noty/mint.css')}}" rel="stylesheet" />
    <script src="{{asset('admin/plugins/noty/noty.min.js')}}"></script>

    {{-- Select2--}}
    <link href="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/css/select2.min.css" rel="stylesheet" />


    <!--Css Animate-->
    <link href="{{asset('admin/css/animate.css')}}" rel="stylesheet" />
    <script src="{{asset('admin/js/wow.min.js')}}"></script>

    <!-- Style Just for persian demo purpose, don't include it in your project -->
    <style>
        body,
        h1,
        h2,
        h3,
        h4,
        h5,
        h6,
        .h1,
        .h2,
        .h3,
        .h4 {
            font-family: "Cairo";
        }

        .bmd-form-group [class^='bmd-label'], .bmd-form-group [class*=' bmd-label']{
            position: relative;
        }
    </style>
    @yield('style')
</head>

<body>
<div id="app">
    @include('layouts.nav')

    @yield('home')
    <main class="py-4 text-right">
        <div class="container-fluid">

            <div class="row">
                <div class="col-md-8 justify-content-start mr-5">
                    @yield('content')
                    <div class="alert alert-danger collapse error" style="display: none"> </div>
                    <div class="alert alert-info text-center collapse info" style="display: none">  </div>
                    @include('admin.layout.session')
                    @include('admin.layout.errors')

                </div>
                <div class="col-md-3 justify-content-end mr-sm-5 mt-sm-3 mr-xs-5 ">
                    @yield('adv')
                </div>
            </div>
        </div>
    </main>
</div>
<script src="{{asset('admin/js/core/jquery.min.js')}}" type="text/javascript"></script>
<script src="{{asset('admin/js/core/popper.min.js')}}" type="text/javascript"></script>
<script src="{{asset('admin/js/core/bootstrap-material-design.min.js')}}" type="text/javascript"></script>
<script src="{{asset('admin/js/plugins/perfect-scrollbar.jquery.min.js')}}"></script>
<script src="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/js/select2.min.js"></script>
<script src="{{asset('admin/demo/demo.js')}}"></script>

<script>
    new WOW().init();
</script>
<!--   Core JS Files   -->

@yield('js')
</body>

</html>


