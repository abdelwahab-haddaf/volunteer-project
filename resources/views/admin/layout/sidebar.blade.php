<style>

    .active a , .active i {
        background-color: #4CAF50 !important;
        color: white !important;
    }
</style>

<div class="sidebar" data-color="purple" data-background-color="white" data-image="{{asset('admin/img/sidebar-1.jpg')}}">
    <!--
      Tip 1: You can change the color of the sidebar using: data-color="purple | azure | green | orange | danger"

      Tip 2: you can also add an image using data-image tag
  -->



    <div class="logo">
        <a href="{{url('/')}}" class="simple-text logo-normal">
         الصفحة الرئيسية للموقع
        </a>
    </div>
    <div class="sidebar-wrapper">
        <ul class="nav">
            <li class="nav-item {{isActive('dashboard')}} ">
                <a class="nav-link" href="{{route('admin.dashboard')}}">
                    <i class="material-icons">dashboard</i>
                    <p>لوحة التحكم</p>
                </a>
            </li>
            {{--users list--}}
            <li class="nav-item {{isActive('user')}}">
                <a class="nav-link" href="#user" data-toggle="collapse" aria-expanded="false">
                    <i class="material-icons">person</i>
                    <p>الاعضاء</p>
                </a>
                <div class="form-group users collapse" id="user" >
                    <ul class="nav">
                        <li class="nav-item">
                            <a  class="nav-link" href="{{route('user.index')}}" > عرض</a>
                            <a  class="nav-link" href="{{route('user.create')}}"> اضافة</a>
                        </li>

                    </ul>
                </div>
            </li>

            {{--users list--}}
            <li class="nav-item {{isActive('charity')}}">
                <a class="nav-link" href="#charity" data-toggle="collapse" aria-expanded="false">
{{--                    <i class="material-icons">group</i>--}}
                    <i class="fa fa-users"></i>
                    <p> جمعيات </p>
                </a>
                <div class="form-group charities collapse" id="charity" >
                    <ul class="nav">
                        <li class="nav-item">
                            <a  class="nav-link" href="{{route('charity.index')}}" > عرض</a>
                            <a  class="nav-link" href="{{route('charity.create')}}"> اضافة</a>
                        </li>

                    </ul>
                </div>
            </li>

            {{--category list--}}
            <li class="nav-item {{isActive('category')}}">
                <a class="nav-link" href="#category" data-toggle="collapse" aria-expanded="false">
                    <i class="material-icons">category</i>
                    <p>التصنيف</p>
                </a>
                <div class="form-group category collapse" id="category" >
                    <ul class="nav">
                        <li class="nav-item">
                            <a  class="nav-link" href="{{route('category.index')}}" > عرض</a>
                            <a  class="nav-link" href="{{route('category.create')}}"> اضافة</a>
                        </li>

                    </ul>
                </div>
            </li>

            {{--city list--}}
            <li class="nav-item {{isActive('city')}}">
                <a class="nav-link" href="#city" data-toggle="collapse" aria-expanded="false">
                    <i class="material-icons">location_on</i>
                    <p>المحافظات</p>
                </a>
                <div class="form-group category collapse" id="city" >
                    <ul class="nav">
                        <li class="nav-item">
                            <a  class="nav-link" href="{{route('city.index')}}" > عرض</a>
                            <a  class="nav-link" href="{{route('city.create')}}"> اضافة</a>
                        </li>

                    </ul>
                </div>
            </li>

            {{--message list--}}
            <li class="nav-item {{isActive('message')}} ">
                <a  class="nav-link" href="{{route('message.index')}}" >
                    <i class="fa fa-envelope"></i>
                    <p>الرسائل &nbsp; ({{count($newMessage)}})</p>
                </a>

            </li>

            {{--post list--}}
            <li class="nav-item {{isActive('post')}}">
                <a class="nav-link" href="#post" data-toggle="collapse" aria-expanded="false">
                    <i class="fa fa-clipboard"></i>
                    <p>المنشورات</p>
                </a>
                <div class="form-group category collapse" id="post" >
                    <ul class="nav">
                        <li class="nav-item">
                            <a  class="nav-link" href="{{route('post.index')}}" > عرض</a>
                            <a  class="nav-link" href="{{route('post.create')}}"> اضافة</a>
                        </li>

                    </ul>
                </div>
            </li>

            {{--advertisement list --}}
            <li class="nav-item {{isActive('advertisement')}}">
                <a class="nav-link" href="#advertisement" data-toggle="collapse" aria-expanded="false">
                    <i class="fa fa-envelope"></i>
                    <p>الاعلانات</p>
                </a>
                <div class="form-group advertisement collapse" id="advertisement" >
                    <ul class="nav">
                        <li class="nav-item">
                            <a  class="nav-link" href="{{route('advertisement.index')}}" > عرض</a>
                            <a  class="nav-link" href="{{route('advertisement.create')}}"> اضافة</a>
                        </li>

                    </ul>
                </div>
            </li>

            {{--logout list  --}}
            <li class="nav-item">
                <a class="nav-link" href="{{ route('logout') }}" data-toggle="collapse" aria-expanded="false"
                   onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                    <i class="fa fa-envelope"></i>
                    <p>تسجيل الخروج</p>
                </a>

                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                    @csrf
                </form>
            </li>

        </ul>
    </div>
</div>

