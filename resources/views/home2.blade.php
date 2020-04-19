@extends('layouts.app')

@section('style')
    <style>
            .opt-menu{
                width: 100px !important;
            }
    </style>
    @endsection

@section('content')
    @foreach($posts as $index=>$post)
       @php
       if ($index%2==1)
            $class = 'slideInLeft';
       else
             $class = 'slideInRight';
       @endphp
    <div class="card m-3 text-right text-primary wow {{$class}}">
        @php
        if ($post->post_type==0)
        $alert = 'alert-danger';
        else
        $alert = 'alert-success';
        @endphp

        <div class="card-header alert {{$alert}}">
            <a href="{{route('front.showPost',['id'=>$post->id ,'slug'=>str_replace(" ","_",$post->title)])}}">
            {{$post->title}}
            </a>
            @if ($post->user_id==auth()->user()->id)
                <div class="dropdown float-left">
                    <button class="btn dropdown-toggle" type="button" id="options" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                       خيارات
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

                <div class="alert alert-default" role="alert">
                <p> {{\Illuminate\Support\Str::limit($post->content,100)}} </p>
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
