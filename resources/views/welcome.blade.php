<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="utf-8" />
    <link rel="apple-touch-icon" sizes="76x76" href="{{asset('admin/img/apple-icon.png')}}">
    <link rel="icon" type="image/png" href="{{asset('admin/img/favicon.png')}}">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
    <link href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">

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



        .home-image {
            margin-top: 52px;
           box-shadow: 20px -20px 0px 0px #ADDCCA;
        }

        .footer .container ul{
            list-style: none;
            float: left;
        }
        .footer .container ul li {
            float: right;
            display: inline;
            margin-right: 10px;
        }
        .footer .container ul li a:hover{
            /*color: #dddddd !important;*/
        }
        .auth-list {
            display: flex;
        }
        .auth-list li {
            list-style: none;
            float: left;
            margin: 0 5px;
        }

        #app nav {
            background: #fff !important;
        }
        #app div .navbar-brand {
            color: orangered;
        }
        #app nav ul li > a {
            color: orangered;
            font-size: 18px;
        }

        #app nav ul li > a:hover {
            color: gray;

        }

        .un-auth-user {
            list-style: none;
        }
        .un-auth-user li {
            float: right;
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

            .un-auth-user {
                display: block;
            }
            .un-auth-user li {
                float: initial;
            }


            .navbar-dark .navbar-toggler {
               background-color: orangered;
            }

            .dropdown-option-list{
                margin-right: 45px;
            }
        }

    </style>

</head>

<body>
<div id="app">
    @include('layouts.nav')

<div class="container-fluid" style="background-color: #ddd">
    <div class="row">
        <div class="col-md-6 p-mt-2 p-0 mt-5">
            <div class="container">
                text
            </div>
        </div>
        <div class="col-md-6 p-mt-2 p-0 mt-5">
            <img src="{{asset('admin/img/home image.jpg')}}" width="98%" class="img-fluid float-left mb-0 home-image" alt="">
        </div>

        <div class="col-12 bg-dark footer">
            <div class="container pt-3 d-flex justify-content-center align-items-center">
                <ul >
                    <li><a href="" class="nav-link  p-0 m-0">Lorem.</a></li>
                    <li><a href="" class="nav-link  p-0 m-0">Quam.</a></li>
                    <li><a href="" class="nav-link  p-0 m-0">Nihil.</a></li>
                </ul>
            </div>
        </div>
    </div>


</div>
</div>
<script src="{{asset('admin/js/core/jquery.min.js')}}" type="text/javascript"></script>
<script src="{{asset('admin/js/core/popper.min.js')}}" type="text/javascript"></script>
<script src="{{asset('admin/js/core/bootstrap-material-design.min.js')}}" type="text/javascript"></script>
<script src="{{asset('admin/js/plugins/perfect-scrollbar.jquery.min.js')}}"></script>

<script>
    new WOW().init();
</script>
<!--   Core JS Files   -->

@yield('js')
</body>

</html>


