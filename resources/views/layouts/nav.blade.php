<nav class="navbar navbar-expand-md navbar-dark bg-dark shadow-sm">
    <div class="container">
                        <a class="navbar-brand" href="{{ url('/') }}">
                            {{ config('app.name', 'Laravel') }}
                        </a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <!-- Left Side Of Navbar -->
            <ul class="navbar-nav " style="margin-right: auto !important;"> <!-- mr-auto -->
                @guest
                    <li class="nav-item mx-3">
                        <a class="btn btn-light" href="{{ route('login') }}">{{ __('تسجيل الدخول ') }}</a>
                    </li>
                    @if (Route::has('register'))
                        <li class="nav-item mx-3">
                            <a class="btn btn-outline-light" href="{{ route('register') }}">{{ __('انشاء حساب') }}</a>
                        </li>
                    @endif
                @else
                    <li class="nav-item dropdown ">
                        <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                            {{ Auth::user()->name }} <span class="caret"></span>
                        </a>



                        <div class="dropdown-menu dropdown-menu-right text-center" aria-labelledby="navbarDropdown">
                            @if (auth()->user()->isAdmin==1)
                                <a class="dropdown-item" href="{{route('admin.dashboard')}}">
                                    لوحة التحكم
                                </a>

                            @endif

                                <a class="dropdown-item" href="{{route('mypost.create')}}">
                                  منشور جديد
                                </a>

                                <a class="dropdown-item" href="{{route('member.show',auth()->user()->id)}}">
                                   الملف الشخصي
                                </a>

                            <a class="dropdown-item" href="{{ route('logout') }}"
                               onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                تسجيل خروج
                            </a>



                            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                @csrf
                            </form>
                        </div>
                    </li>
                @endguest
            </ul>


        </div>
    </div>
</nav>
