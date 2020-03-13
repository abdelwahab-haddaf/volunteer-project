@extends('admin.layout.app')

@section('content')


    <div class="row">
        <div class="col-lg-3 col-md-6 col-sm-6">
            <div class="card card-stats">
                <div class="card-header card-header-warning card-header-icon">
                    <div class="card-icon">
                        <i class="fa fa-users"></i>
                    </div>
                    <p class="card-category ">
                        عدد المستخدمين
                    </p>
                    <h4 class="card-title ">
                        {{count($users)}}
                        <small>مستخدم</small>
                    </h4>
                </div>
                <div class="card-footer">
                    <div class="stats">
                        <i class="material-icons text-info">info</i>
                        <p>  لاستعراض المستخدمين </p> &nbsp;
                        <a href="{{route('user.index')}}">
                            اضغط هنا
                        </a>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-md-6 col-sm-6">
            <div class="card card-stats">
                <div class="card-header card-header-success card-header-icon">
                    <div class="card-icon">
                        <i class="fa fa-clipboard"></i>
                    </div>
                    <p class="card-category ">
                        عدد المنشورات
                    </p>
                    <h4 class="card-title ">
                        {{count($posts)}}
                        <small>منشور</small>
                    </h4>
                </div>
                <div class="card-footer">
                    <div class="stats">
                        <i class="material-icons text-info">info</i>
                      <p>  لاستعراض المنشورات </p> &nbsp;
                        <a href="{{route('post.index')}}">
                            اضغط هنا
                        </a>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-md-6 col-sm-6">
            <div class="card card-stats">
                <div class="card-header card-header-info card-header-icon">
                    <div class="card-icon">
                        <i class="fa fa-envelope"></i>
                    </div>
                    <p class="card-category ">
                        عدد الرسائل
                    </p>
                    <h4 class="card-title ">
                        {{count($messages)}}
                        <small>رسالة</small>
                    </h4>
                </div>
                <div class="card-footer">
                    <div class="stats">
                        <i class="material-icons text-info">info</i>
                        <p>  لاستعراض الرسائل </p> &nbsp;
                        <a href="{{route('message.index')}}">
                            اضغط هنا
                        </a>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-md-6 col-sm-6">
            <div class="card card-stats">
                <div class="card-header card-header-rose card-header-icon">
                    <div class="card-icon">
                        <i class="material-icons">category</i>

                    </div>
                    <p class="card-category ">
                        عدد التصنيفات
                    </p>
                    <h4 class="card-title ">
                        {{count($categories)}}
                        <small>تصنيف</small>
                    </h4>
                </div>
                <div class="card-footer">
                    <div class="stats">
                        <i class="material-icons text-info">info</i>
                        <p>  لاستعراض التصنيفات </p> &nbsp;
                        <a href="{{route('category.index')}}">
                            اضغط هنا
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
{{--        @for($i=0 ; $i<1 ; $i++ )--}}
            <div class="col-md-4">
                <div class="card card-chart">
                    <div class="card-header card-header-success">
                        <div class="ct-chart" id="dailySalesChart"></div>
                    </div>
                    <div class="card-body">
                        <h4 class="card-title">فروش روزانه</h4>
                        <p class="card-category">
                    <span class="text-success">
                      <i class="fa fa-long-arrow-up"></i> 55% </span> رشد در فروش امروز.</p>
                    </div>
                    <div class="card-footer">
                        <div class="stats">
                            <i class="material-icons">access_time</i> ۴ دقیقه پیش
                        </div>
                    </div>
                </div>
            </div>
{{--            @endfor--}}


        <div class="col-md-4">
            <div class="card card-chart">
                <div class="card-header card-header-warning">
                    <div class="ct-chart" id="websiteViewsChart"></div>
                </div>
                <div class="card-body">
                    <h4 class="card-title">دنبال کننده‌های ایمیلی</h4>
                    <p class="card-category">کارایی آخرین کمپین</p>
                </div>
                <div class="card-footer">
                    <div class="stats">
                        <i class="material-icons">access_time</i> کمپین دو روز پیش ارسال شد
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card card-chart">
                <div class="card-header card-header-danger">
                    <div class="ct-chart" id="completedTasksChart"></div>
                </div>
                <div class="card-body">
                    <h4 class="card-title">وظایف انجام شده</h4>
                    <p class="card-category">کارایی آخرین کمپین</p>
                </div>
                <div class="card-footer">
                    <div class="stats">
                        <i class="material-icons">access_time</i> کمپین دو روز پیش ارسال شد
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-6 col-md-12">
            <div class="card">
                <div class="card-header card-header-warning">
                    <h4 class="card-title">انضم حديثا</h4>
                    <p class="card-category">آخر خمسة أعضاء تم انضمامهم إلينا</p>
                </div>
                <div class="card-body table-responsive">
                    <table class="table table-hover">
                        <thead class="text-warning">
                        <th>الرقم</th>
                        <th>الاسم</th>
                        <th>الايميل</th>
                        <th>نوع المستخدم</th>
                        </thead>
                        <tbody>
                        @foreach($last_users as $index=>$lu)
                        <tr>
                            <td>{{$index+1}}</td>
                            <td>{{$lu->name}}</td>
                            <td>{{$lu->email}}</td>
                            @if($lu->isAdmin==0)
                            <td>User</td>
                                @else
                            <td>Admin</td>
                                @endif
                        </tr>
                        @endforeach

                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <div class="col-lg-6 col-md-12">
            <div class="card">
                <div class="card-header card-header-success">
                    <h4 class="card-title">آخر المنشورات</h4>
                    <p class="card-category">آخر خمسة منشورات تم نشرها عبر الموقع</p>
                </div>
                <div class="card-body table-responsive">
                    <table class="table table-hover">
                        <thead class="text-warning">
                        <th>الرقم</th>
                        <th>العنوان</th>
                        <th>اسم المستخدم</th>
{{--                        <th>نوع البوست</th>--}}
                        </thead>
                        <tbody>
                        @foreach($last_posts as $index=>$p)
                            <tr>
                                <td>{{$index+1}}</td>
                                <td>{{$p->title}}</td>
                                <td>{{$p->user->name}}</td>
{{--                                @if($lu->post type==0)--}}
{{--                                    <td>User</td>--}}
{{--                                @else--}}
{{--                                    <td>Admin</td>--}}
{{--                                @endif--}}
                            </tr>
                        @endforeach

                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>





    <div class="row">
        <div class="col-lg-6 col-md-12">
            <div class="card">
                <div class="card-header card-header-primary">
                    <h3 class="card-title">اعلان ها</h3>
                    <p class="card-category">ایجاد شده توسط دوست ما
                        <a target="_blank" href="https://github.com/mouse0270">Robert McIntosh</a>. لطفا
                        <a href="http://bootstrap-notify.remabledesigns.com/" target="_blank">مستندات کامل </a> را مشاهده بکنید.
                    </p>
                </div>
                <div class="card-body">
                    <div class="alert alert-warning">
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <i class="material-icons">close</i>
                        </button>
                        <span>
                      این یک اعلان است که با کلاس "alert-warning" ایجاد شده است.</span>
                    </div>
                    <div class="alert alert-primary">
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <i class="material-icons">close</i>
                        </button>
                        <span>
                      این یک اعلان است که با کلاس "alert-primary" ایجاد شده است.</span>
                    </div>
                    <div class="alert alert-info alert-with-icon" data-notify="container">
                        <i class="material-icons" data-notify="icon">add_alert</i>
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <i class="material-icons">close</i>
                        </button>
                        <span data-notify="پیام">این یک اعلان با دکمه بستن و آیکن است</span>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-6 col-md-12">
            <div class="card card-profile">
                <div class="card-avatar">
                    <a href="#pablo">
                        <img class="img" src="{{asset('admin/img/faces/marc.jpg')}}" />
                    </a>
                </div>
                <div class="card-body">
                    <h6 class="card-category text-gray">مدیرعامل / مدیرفنی</h6>
                    <h4 class="card-title">خداداد عزیزی</h4>
                    <p class="card-description">
                        طراح گرافیک از این متن به عنوان عنصری از ترکیب بندی برای پر کردن صفحه و ارایه اولیه شکل ظاهری و کلی طرح سفارش گرفته شده استفاده می نماید، تا از نظر گرافیکی نشانگر چگونگی نوع و اندازه فونت و ظاهر متن باشد. معمولا طراحان گرافیک برای صفحه‌آرایی، نخست از متن‌های آزمایشی و بی‌معنی استفاده می‌کنند ...
                    </p>
                    <a href="#pablo" class="btn btn-primary btn-round">دنبال‌کردن</a>
                </div>
            </div>
        </div>
    </div>


@endsection
