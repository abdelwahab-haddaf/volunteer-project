@extends('layouts.app')

@section('title')
    {{$user->name}}
@endsection


@section('page_title')
    {{$user->name}}
@endsection

@section('content')

    <div class="container p-3 mx-5" style="background-color: #fff">
        <div class="row d-flex justify-content-start">
            <div class="col-6 wow slideInRight">
                <div class="form-group" dir="rtl">
                    <label for="">الاسم :</label>
                    <p class="bg-light">{{$user->name}}</p>
                </div>
                @if ($extra != null)
                    @if ($extra->bio != null)
                        <div class="form-group" >
                            <label for="">نبذة :</label>
                            <p class="bg-light">{{$extra->bio}}</p>
                        </div>
                    @endif

                @endif
                <div class="form-group">
                    <label for="">الايميل :</label>
                    <p class="bg-light">{{$user->email}}</p>
                </div>

                @if($user->isAdmin==1)
                <div class="form-group">
                    <label for="">نوع المستخدم </label>
                    <p class="bg-light">مدير الموقع :</p>
                </div>
                @endif

                <div class="form-group">
                    <label for="">تاريخ الانضمام :</label>
                    <p class="bg-light">{{$user->created_at->format('d m y')}}</p>
                </div>
                @if ($extra != null)

                @if ($extra->phone != null)
                <div class="form-group">
                    <label for="">رقم الجوال :</label>
                    <p class="bg-light">{{isset($extra)? $extra->phone: 'لا يوجد'}}</p>
                </div>
                @endif
                @if ($extra->address != null)
                <div class="form-group">
                    <label for=""> العنوان :</label>
                    <p class="bg-light">{{isset($extra)? $extra->address:''}}</p>
                </div>
                @endif
                @if ($extra->study != null)
                <div class="form-group">
                    <label for="">التخصص :</label>
                    <p class="bg-light">{{isset($extra)? $extra->study :''}}</p>
                </div>
                @endif
                @if ($extra->skills != null)
                    <div class="form-group">
                        <label for="">المهارات :</label>
                        @php
                            $skills = explode('-',isset($extra)? $extra->skills:'');
                        @endphp
                        @foreach($skills as $skill)
                            <span class="bg-light m-1">{{$skill}} </span>
                        @endforeach
                    </div>
                @endif

                @endif <!-- end of extra != null -->


            </div>
            <div class="col-6 d-flex align-items-center justify-content-center">
                @if($extra != null)
                @if($extra->image !=null)
                    <img src="{{asset('users_image/'.$extra->image)}}" class="rounded-circle wow rollIn" alt="{{$extra->image}}" style="width: 200px;height: 200px;object-fit: cover">
                @else
                <img src="http://placehold.it/200" class="img-fluid rounded-circle wow rollIn " alt="">
                    @endif
                    @endif
            </div>





            @if ($user->id == auth()->user()->id)
                <a href="{{route('member.edit',auth()->user()->id)}}" class="nav-link btn btn-outline-dark m-2 ">تعديل الملف الشخصي</a>
                <a href="{{route('member.editPassword',auth()->user()->id)}}" class="nav-link btn btn-outline-dark m-2 ">تعديل كلمة المرور</a>
            @endif

        </div>
    </div>


@endsection

@section('adv')


    <div class="card">
        <img class="card-img" src="http://placehold.it/200" alt="Card image">
        <div class="card-img-overlay">
            <p class="card-text">I'm text that has a background image!</p>
        </div>
    </div>



@endsection

@section('js')
{{--    <script>--}}

{{--        $(document).on('submit','#create',function (e) {--}}
{{--            e.preventDefault();--}}
{{--            var url = $(this).attr('action'),--}}
{{--                request = $.ajax({--}}
{{--                    headers: {--}}
{{--                        'X-CSRF-TOKEN':$('input[name="_token"]').val()--}}
{{--                    },--}}
{{--                    url:url,--}}
{{--                    method:"post",--}}
{{--                    data: new FormData(this),--}}
{{--                    dataType:"json",--}}
{{--                    cache:false,--}}
{{--                    contentType:false,--}}
{{--                    processData:false,--}}
{{--                    beforeSend:function () {--}}
{{--                        $('.error').hide();--}}
{{--                        $('.error').empty();--}}
{{--                    },--}}
{{--                    success: function () {--}}

{{--                        new Noty({--}}
{{--                            type:'success',--}}
{{--                            layout:'bottomCenter',--}}
{{--                            text:"تم ادخال البيانات بنجاح",--}}
{{--                            timeout:5000,--}}
{{--                            killer: true,--}}
{{--                        }).show();--}}

{{--                        $('.name').val('');--}}
{{--                        $('.desc').val('');--}}

{{--                    },--}}
{{--                    error: function (xhr) {--}}
{{--                        $('.error').show();--}}
{{--                        console.log((xhr.responseJSON.errors));--}}
{{--                        $('.error').html('');--}}

{{--                        $.each(xhr.responseJSON.errors, function(key,value) {--}}
{{--                            $('.error').append('<li>'+value+'</li>');--}}
{{--                        });--}}
{{--                    }--}}

{{--                });--}}

{{--        });--}}
{{--    </script>--}}

@endsection

