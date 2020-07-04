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
    <link href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">
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

        body {
            background-color: #F7F8F3;
        }
        .auth-list {
            display: flex;
        }

        .auth-list li {
            list-style: none;
            float: left;
            margin: 0 5px;
        }

        .un-auth-user {
            list-style: none;
        }


        .un-auth-user li {
            float: right;
        }
        .un-auth-user li a {
           color: white;
        }

        .un-auth-user li a:hover {
            color: orangered !important;
        }

        nav .auth-list li .active-list,
        .un-auth-user li .active-list{
            color: orangered !important;
        }

        @media only screen and (min-width: 769px) {
            .dropdown-option-list{
                margin-left: 70px;
            }
        }

        @media only screen and (max-width: 768px) {



            .auth-list {
                display: block;
            }
            .auth-list li {
                float: initial;
            }

            .dropdown-option-list{
                margin-right: 45px;
            }

            .navbar-dark .navbar-toggler {
                background-color: orangered;
            }

            .un-auth-user {
                display: block;
            }
            .un-auth-user li {
                float: initial;
            }



        }

    </style>
    @yield('style')
</head>

<body>
<div id="app">
    @include('layouts.nav')
    {{--         للاستخدام فقط في الصفحة الرئيسية  --}}
    @yield('home')
    <main class="py-4 text-right">
        <div class="container-fluid">

{{--         للاستخدام فقط في صفحىة تواصل معنا   --}}
            @yield('oldContact-us')
            <div class="row">
                <div class="col-md-8 justify-content-start mr-5">
                    @yield('content')
{{--                    <div class="alert alert-danger collapse error" style="display: none"> </div>--}}
                    <div class="alert alert-info text-center collapse info" style="display: none">  </div>
                    @include('admin.layout.session')
{{--                    @include('admin.layout.errors')--}}

                </div>
                <div class="col-md-3 justify-content-start mr-sm-2 mr-xs-2">
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


