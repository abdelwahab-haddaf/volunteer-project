@extends('layouts.app')

@section('title')
    {{$user->name}}
@endsection

@section('style')
    <style>
.advertisement {
    width: 80%;
    height: 207px;
}
.advertisement img {
    height: 100%;
}
.personal-image img{
    width: 200px;
    height: 200px;
    object-fit: cover;
        }

    </style>
    @endsection

@section('page_title')
    {{$user->name}}
@endsection



@section('content')

    <div class="container px-4">
        <div class="row">
            <div class="col-4 bg-white p-3 d-flex justify-content-center personal-image">
                @if($extra != null)
                @if($extra->image != null)
                <img src="{{asset('users_image/'.$extra->image)}}" class="img-fluid" alt="{{$extra->image}}">
                    @else
                        <img src="http://placehold.it/250" class="img-fluid rounded-top" alt="">
                    @endif
                @else
                <img src="http://placehold.it/250" class="img-fluid rounded-top" alt="">
                @endif
            </div>
            <div class="col-8 bg-white p-3">
                <div class="d-inline-block" style="width: 100%;">
                    <h3 class="float-right">{{$user->name}}</h3>

                    @if ($user->id == auth()->user()->id)
                        <div class="float-left  d-flex justify-content-between">
                            <a href="{{route('member.edit',auth()->user()->id)}}" class="nav-link btn btn-outline-dark mx-1  ">تعديل الملف الشخصي</a>
                            <a href="{{route('member.editPassword',auth()->user()->id)}}" class="nav-link btn btn-outline-dark mx-1 ">تعديل كلمة المرور</a>
                        </div>

                    @endif

                </div>
                @if($extra != null)
                @if($extra->bio != null)
                    <p>{!!nl2br($extra->bio)!!}</p>
                    @endif
                @endif

            </div>
            <div class="col-12 bg-white p-3">
                <table class="table table-bordered text-center">

                    <tbody>
                    <tr>
                        <td>
                            <i class="fa fa-envelope"></i>
                             الايميل :
                            {{$user->email}}</td>
                        <td>
                            <i class="fa fa-phone"></i>
                            {{isset($extra->phone)  ? $extra->phone :'غير متاح'}}

                        </td>
                        <td>
                            <i class="fa fa-calendar"></i>
                            {{isset($user->created_at)  ? $user->created_at->format('d-m-y') :'غير متاح'}}
                        </td>
                        <td>
                            <i class="fa fa-briefcase"></i>
                            {{isset($extra->work)  ? $extra->work :'غير متاح'}}

                        </td>
                    </tr>
                    <tr>
                        <td colspan="2">
                            <i class=" fa fa-map-marker"></i>
                            {{isset($extra->address)  ? $extra->address :'غير متاح'}}
                        </td>
                        <td colspan="2">
                            <i class="fa fa-graduation-cap"></i>
                            {{isset($extra->study)  ? $extra->study :'غير متاح'}}

                        </td>
                    </tr>
                    <tr>
                        <td colspan="4">
                            <i class="fa fa-star"></i>
                            {{isset($extra->skills)  ? $extra->skills :'غير متاح'}}

                        </td>
                    </tr>
                    </tbody>
                </table>

            </div>
        </div>
    </div>

@endsection



@section('adv')


    <div class="card advertisement">
        <img class="card-img" src="http://placehold.it/200" alt="Card image">
        <div class="card-img-overlay">
            <p class="card-text">I'm text that has a background image!</p>
        </div>
    </div>

    <div class="card advertisement mt-2">
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

