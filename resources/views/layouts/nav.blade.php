

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
            <ul class="navbar-nav  justify-content-between " style="margin-right: auto !important; width: 100%;"> <!-- mr-auto -->
                @guest
                    <ul class="un-auth-user">
                        <li class="nav-item mx-3">
                            <a class="btn {{activeList('login')}} " href="{{ route('login') }}">{{ __('تسجيل الدخول ') }}</a>
                        </li>
                        @if (Route::has('register'))
                            <li class="nav-item mx-3">
                                <a class="btn {{activeList('register')}} " href="{{ route('register') }}">{{ __('انشاء حساب') }}</a>
                            </li>
                        @endif
                        <li><a href="{{route('contactUs')}}" class="nav-link {{activeList('contact-us')}} ">تواصل معنا</a></li>

                    </ul>

                @else


                        <ul class="float-right align-items-center auth-list" >
                            <li><a href="{{route('home')}}" class="nav-link {{activeList('home')}}  p-0 m-0">الصفحة الرئيسية</a></li>
                            <li><a href="{{route('member.show',auth()->user()->id)}}" class="nav-link {{activeList('member')}}  p-0 m-0">الصفحة الشخصية </a></li>
                            <li><a href="{{route('mypost.create')}}" class="nav-link  {{activeList('mypost')}} p-0 m-0">منشور جديد</a></li>
                            <li><a href="{{route('contactUs')}}" class="nav-link {{activeList('contact-us')}} p-0 m-0 ">تواصل معنا</a></li>
                        </ul>


 <ul class="d-flex align-items-center search-area">
     <form action="{{route('home')}}" method="get">
         <div class="input-group">
             <div class="input-group-prepend">
                 <button class="btn search-button" type="submit" style="background-color: orangered"><i class="fa fa-search"></i></button>
             </div>
             <input type="text" class="form-control" name="search" aria-label="" aria-describedby="basic-addon1" value="{{request('search')}}">
         </div>
     </form>
 </ul>


 <li class="nav-item dropdown dropdown-option-list ">
    <a id="navbarDropdown" class="nav-link " href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre style="font-size: 17px">
{{--  {{ Auth::user()->name }} <span class="caret"></span>--}}

            @if (auth()->user()->image != null)
                <img src="{{asset('users_image/'.auth()->user()->image)}}" width="25" height="25" class="img-fluid rounded-top rounded-bottom" alt="">

            @else
            <img src="{{asset('users_image/user-default.png')}}" width="25" height="25" class="img-fluid rounded-top rounded-bottom" alt="">
            @endif
                        </a>

                        <div class="dropdown-menu dropdown-menu-right text-center" aria-labelledby="navbarDropdown">
                            @if (auth()->user()->isAdmin==1)
                                <a class="dropdown-item" href="{{route('admin.dashboard')}}">
                                    لوحة التحكم
                                </a>

                            @endif

                            @if ($myChartity != null)
                                @foreach($myChartity as $char)
                                    <a class="dropdown-item" href="{{route('charities.show',$char->id)}}">

                                        {{$char->name}}
                                    </a>
                                    @endforeach
                            @endif

                                <a class="dropdown-item" href="{{route('charity.create')}}">
                                    جمعية جديدة
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
