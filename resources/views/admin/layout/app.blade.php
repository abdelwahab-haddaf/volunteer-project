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
    <meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0, shrink-to-fit=no' name='viewport' />
    <!-- Extra details for Live View on GitHub Pages -->
    <!-- Canonical SEO -->
    <link rel="canonical" href="https://www.creative-tim.com/product/material-dashboard" />
    <!--  Social tags      -->
    <meta name="keywords" content="creative tim, html dashboard, html css dashboard, web dashboard, bootstrap 4 dashboard, bootstrap 4, css3 dashboard, bootstrap 4 admin, material dashboard bootstrap 4 dashboard, frontend, responsive bootstrap 4 dashboard, free dashboard, free admin dashboard, free bootstrap 4 admin dashboard">
    <meta name="description" content="Material Dashboard is a Free Material Bootstrap Admin with a fresh, new design inspired by Google's Material Design.">
    <!-- Schema.org markup for Google+ -->
    <meta itemprop="name" content="Material Dashboard by Creative Tim">
    <meta itemprop="description" content="Material Dashboard is a Free Material Bootstrap Admin with a fresh, new design inspired by Google's Material Design.">
    <meta itemprop="image" content="https://s3.amazonaws.com/creativetim_bucket/products/50/opt_md_thumbnail.jpg">

    <!--     Fonts and icons     -->
    <link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700|Roboto+Slab:400,700|Material+Icons" />
{{--    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/latest/css/font-awesome.min.css">--}}
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <!-- Markazi Text font include just for persian demo purpose, don't include it in your project -->
    <link href="https://fonts.googleapis.com/css?family=Cairo&amp;subset=arabic" rel="stylesheet">
    <!-- CSS Files -->
    <link href="{{asset('admin/css/material-dashboard.css')}}" rel="stylesheet" />
    <link href="{{asset('admin/css/material-dashboard-rtl.css')}}" rel="stylesheet" />
    <!-- CSS Just for demo purpose, don't include it in your project -->
    <link href="{{asset('admin/demo/demo.css')}}" rel="stylesheet" />
    <!-- Noty plugins -->
    <link href="{{asset('admin/plugins/noty/noty.css')}}" rel="stylesheet" />
    <link href="{{asset('admin/plugins/noty/mint.css')}}" rel="stylesheet" />
    <script src="{{asset('admin/plugins/noty/noty.min.js')}}"></script>
    {{-- Select2--}}
    <link href="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/css/select2.min.css" rel="stylesheet" />

    {{--    Data table css --}}
    <link href="https://cdn.datatables.net/1.10.16/css/jquery.dataTables.min.css" rel="stylesheet">
    <link href="https://cdn.datatables.net/1.10.19/css/dataTables.bootstrap4.min.css" rel="stylesheet">

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

<body class="">

<div class="wrapper ">
@include('admin.layout.sidebar')
    <div class="main-panel">
@include('admin.layout.nav')
        <div class="content">

                    @yield('content')
                @include('admin.layout.session')
{{--                @include('admin.layout.errors')--}}


            <footer class="footer">
                <div class="container-fluid">
                    <nav class="float-left">
                        <ul>
                            <li>
                                <a href="https://www.creative-tim.com">
                                    تیم خلاق
                                </a>
                            </li>
                            <li>
                                <a href="https://creative-tim.com/presentation">
                                    درباره ما
                                </a>
                            </li>
                            <li>
                                <a href="http://blog.creative-tim.com">
                                    بلاگ
                                </a>
                            </li>
                            <li>
                                <a href="https://www.creative-tim.com/license">
                                    اجازه نامه
                                </a>
                            </li>
                        </ul>
                    </nav>
                    <div class="copyright float-right">
                        &copy;
                        <script>
                            document.write(new Date().getFullYear())
                        </script>, ساخته شده با
                        <i class="material-icons">favorite</i> توسط
                        <a href="https://www.creative-tim.com" target="_blank">تیم خلاق</a> برای وب بهتر.
                    </div>
                </div>
            </footer>
        </div>
    </div>

</div>
    <!--   Core JS Files   -->
    <script src="{{asset('admin/js/core/jquery.min.js')}}" type="text/javascript"></script>
    <script src="{{asset('admin/js/core/popper.min.js')}}" type="text/javascript"></script>
    <script src="{{asset('admin/js/core/bootstrap-material-design.min.js')}}" type="text/javascript"></script>
    <script src="{{asset('admin/js/plugins/perfect-scrollbar.jquery.min.js')}}"></script>

{{--    <script src="{{asset('admin/js/material-dashboard.min.js')}}" type="text/javascript"></script>--}}
    <!-- Material Dashboard DEMO methods, don't include it in your project! -->
    <script src="{{asset('admin/demo/demo.js')}}"></script>
    {{--Datatable js --}}
    <script src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>

    <script src="https://cdn.datatables.net/1.10.19/js/dataTables.bootstrap4.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/js/select2.min.js"></script>
    <script>
        new WOW().init();
    </script>
    @yield('js')

</body>

</html>
