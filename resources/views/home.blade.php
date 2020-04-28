@extends('layouts.app')

@section('style')
    <style>
            .opt-menu{
                width: 100px !important;
            }

            .user-image {
                width: 50px;
                height: 50px;
                object-fit: cover;
            }

        table thead th {
            vertical-align: middle !important;
            border-bottom:none !important;
                }

        .user-name {
            margin-top: 12px;
        }


</style>
    @endsection

@section('title')
الرئيسية
@endsection

@section('content')
    @foreach($posts as $index=>$post)
        @php
        if ($index%2==1)
        $class = 'slideInLeft';
        else
        $class = 'slideInRight';
        @endphp
        <div class="card wow {{$class}} mb-2" dir="rtl">
        @php
            if ($post->post_type==1)
                $bg_color = '#ADDCCA';
            else
                $bg_color = '#FE6F5E';
        @endphp

            <div class="card-header m-0" style="background-color: {{$bg_color}}">
                <h4 class="text-right d-inline"> {{$post->title}}</h4>


                @if ($post->user_id==auth()->user()->id)
                    <div class="dropdown float-left">
                        <button class="btn" type="button" id="options" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
{{--                            خيارات--}}
                            <i class="fa fa-chevron-circle-down"></i>
                        </button>
                        <div class="dropdown-menu opt-menu" aria-labelledby="options" >
                            <a class="dropdown-item text-center" href="{{route('mypost.edit',$post->id)}}" >تعديل المنشور </a>
                            <form action="{{route('front.deletePost',$post->id)}}" method="post" id="delete">
                                @csrf
                                @method('delete')
                                <button type="submit" class="dropdown-item text-center delete">حذف المنشور</button>
                            </form>
                        </div>
                    </div>
                @endif
            </div>
            <div class="card-body p-0">
                <table class="table table-bordered m-0">
                    <thead>
                    <tr>
                        <th>
{{--                            <span>{{$post->user->id}}</span>--}}
                            @if ($post->user->userInfo != null)
                                <img src="{{asset('users_image/'.$post->user->userInfo->image)}}" class="img-fluid rounded-circle float-right mr-3 user-image" alt="">
{{--                                <span> {{$post->user->userInfo->image}} </span>--}}
                            @else
                                <img src="http://placehold.it/50" class="img-fluid rounded-top float-right mr-3" alt="">

                            @endif
                            <p class="text-right user-name">{{$post->user->name}}</p>
                        </th>
                        <th class="mb-2">{{$post->city->name}}</th>
                        <th>{{$post->address}} </th>
                        <th>{{$post->created_at->format('d/m/y')}}</th>
                    </tr>
                    </thead>

                </table>

                <div class="content p-4 ">
                    <p> {{\Illuminate\Support\Str::limit($post->content,100)}} </p>
                </div>

                <div class="button m-4">
                    <button type="button" class="btn mx-2" style="background-color: {{$bg_color}}">ارسل رسالة</button>

                    <a href="{{route('front.showPost',['id'=>$post->id ,'slug'=>str_replace(" ","_",$post->title)])}}" class="btn" style="background-color: {{$bg_color}}">
                    اقرأ المزيد
                    </a>
                </div>
            </div>


        </div>


    @endforeach
    <div class="d-flex justify-content-center">
        {{$posts->links()}}
    </div>
@endsection


@section('adv')


        <div class="card text-center">
            <a href="{{$adv->url}}" class="nav-link text-dark">
            <img class="card-img" src="{{asset('image/'.$adv->image)}}" alt="Card image" style="width: 100%; opacity: 0.5;">
            <div class="card-img-overlay">
                <h2>{{$adv->title}}</h2>
                <p class="card-text">{{$adv->content}}</p>
            </div>
            </a>
        </div>

{{--




--}}

@endsection


@section('js')

                <script>

                    $(document).on('click','.delete',function (e) {
                        e.preventDefault();

                        var that = $(this);
                        var n = new Noty({
                            text:'تأكيد عملية الحذف ' ,
                            type:'error',
                            killer:true,
                            layout:'bottomCenter',
                            buttons:[
                                Noty.button('نعم','btn btn-danger m-2',function () {
                                    that.closest('form').submit();
                                    that.parents(".card").remove()
                                }),
                                Noty.button('لا','btn btn-success m-2',function () {
                                    n.close();
                                })
                            ]
                        });
                        n.show();

                    });
                    $(document).on('submit','form#delete',function (e) {
                        e.preventDefault();
                        var url = $(this).attr('action'),
                            request = $.ajax({
                                headers: {
                                    'X-CSRF-TOKEN':$('input[name="_token"]').val()
                                },
                                url:url,
                                method:"post",
                                data: new FormData(this),
                                dataType:"json",
                                cache:false,
                                contentType:false,
                                processData:false,
                                beforeSend:function () {

                                },
                                success: function () {

                                    new Noty({
                                        type:'success',
                                        layout:'bottomCenter',
                                        text:"تم حذف البيانات بنجاح",
                                        timeout:5000,
                                        killer: true,
                                    }).show();

                                },
                                error: function (xhr) {
                                    $('.error').show();
                                    console.log((xhr.responseJSON.errors));
                                    $('.error').html('');

                                    $.each(xhr.responseJSON.errors, function(key,value) {
                                        $('.error').append('<li>'+value+'</li>');
                                    });
                                }

                            });

                    });

                </script>


    @endsection
