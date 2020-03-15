<!doctype html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>
<body>
    <div id="app">
@include('layouts.nav')
        <main class="py-4 text-right">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-8 justify-content-start mr-5">
                        @yield('content')
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

@yield('js')
</body>
</html>
