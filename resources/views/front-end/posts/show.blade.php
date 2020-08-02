@extends('layouts.app')

@section('style')
    <style>

        .attatchment-images {
            display: block;
            height: 200px;
            width: 400px;
        }

        .category-list {
            list-style: none;
            float: right;
        }
        .category-list li {
            float: right;
        }
/*
 background-color: white;
            color: #addcca;
            border-radius: 10px;
*/

        .category-list li a {
             @if($post->post_type==1)
                background-color: #addcca;
             @else
                background-color: #FE6F5E;
             @endif
            color: white;
            border-radius: 10px;
            margin: 0 5px;
        }


        .category-list li a:hover {
            @if($post->post_type==1)
            color: #addcca;
            background-color: white;;
            @else
            color: #FE6F5E;
            background-color: white;;
            @endif
border-radius: 10px;
        }


        @media only screen and (max-width: 768px) {

            .attatchment-images {
                height: 200px;
                width: 170px;
                display: block;
            }
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


            @if($post->post_type==0)
             .card-header h4 {
                color: black;
            }
            .button button , .button a {
                color: black;
            }
            @else
            .card-header h4 {
                color: white;
            }
        .button button , .button a {
               color: white;
        }
            @endif
}
    </style>
    @endsection

@section('content')

    <div class="row">
        <div class="col-12">
            <div class="card mb-2" dir="rtl">
                @php
                    if ($post->post_type==1)
                    $bg_color = '#ADDCCA';
                    else
                    $bg_color = '#FE6F5E';
                @endphp

                <div class="card-header m-0" style="background-color: {{$bg_color}};">
                    <h4 class="text-right d-inline"> {{$post->title}}</h4>


                    @if ($post->user_id==auth()->user()->id)
                        <div class="dropdown float-left">
                            <button class="btn " type="button" id="options" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                {{--                            خيارات--}}
                                <i class="fa fa-chevron-circle-down"></i>
                            </button>
                            <div class="dropdown-menu opt-menu" aria-labelledby="options" >
                                <a class="dropdown-item text-center" href="{{route('mypost.edit',$post->id)}}" >تعديل المنشور </a>
                                <button type="button" class="dropdown-item text-center" data-toggle="modal" data-target="#confirmDelete">حذف المنشور</button>
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
                                @if ($post->user->image != null)
                                    <img src="{{asset('users_image/'.$post->user->image)}}" class="img-fluid rounded-circle float-right mr-3 user-image" alt="">
                                    {{--                                <span> {{$post->user->userInfo->image}} </span>--}}
                                @else
                                    <img src="http://placehold.it/50" class="img-fluid rounded-top float-right mr-3" alt="">

                                @endif
                                <p class="text-right user-name">{{$post->user->name}} {{isset($post->charity->name) ? " - ".$post->charity->name : ""}}</p>
                            </th>
                            <th class="mb-2">{{$post->city->name}}</th>
                            <th>{{$post->address}} </th>
                            <th>{{$post->created_at->format('d/m/y')}}</th>
                        </tr>
                        </thead>

                    </table>

                    <div class="content p-4 ">
                        <p> {{$post->content}} </p>
                    </div>

                    <div class="button m-4">
                        <button type="button" class="btn mx-2" style="background-color: {{$bg_color}};">ارسل رسالة</button>
                        <a href="#comment-area" class="btn mx-2" style="background-color: {{$bg_color}};">اضافة تعليق</a>

                    </div>
                </div>


            </div>
        </div>

    </div>
    {{--Modal for confirmation  --}}
    <div class="modal fade" id="confirmDelete" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">تأكيد حذف </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <p> {{\Illuminate\Support\Str::limit($post->content,100)}} </p>

                </div>
                <div class="modal-footer d-flex justify-content-start">
                    <form action="{{route('mypost.destroy',$post->id)}}" method="post">
                        @csrf
                        @method('delete')
                        <button type="submit" class="btn btn-outline-success">حذف</button>
                    </form>
                    <button type="button" class="btn btn-outline-danger" data-dismiss="modal">الغاء</button>
                </div>
            </div>
        </div>
    </div>




    @if(count($images)>0)
        <div class="form-group text-right">
            <label for="">الصور المرفقة : </label>
            <div class="row">
                @foreach($images as $image)
                    @php
                        $imagesImploded = $image->name;
                        $imagesExploded = explode('|', $imagesImploded);
                    @endphp

                    @foreach($imagesExploded as $img)
                        <div class="col-md-4">
                            <a href="{{url(asset('image/'.trim($img)))}}">
                                <img src="{{ asset('image/'.trim($img)) }}" class="img-fluid rounded-top attatchment-images" > <br>
                            </a>
                        </div>
                    @endforeach

                @endforeach
            </div>
        </div>
        <hr>
    @endif


    <div class="form-group align-items-center text-right">
        <div class="row">
            <ul class="category-list">
                @foreach($post->categories as $cat)
                        <li>
                            <a href="{{route('front.category',['id'=>$cat->id ,'slug'=>str_replace(" ","_",$cat->name)] )}}" class="nav-link"> {{$cat->name}} </a>
                        </li>
                @endforeach
            </ul>

           </div>
        <hr>


        <div class="row">

            <div class="col-md-9">
                @foreach($post->comments as $comment )

                    <div class="card my-1">
                        <div class="card-header">
                          {{$comment->user->name}}
                        </div>
                        <div class="card-body">
                            <p class="card-text">{{$comment->comment}}</p>
                        </div>
                    </div>

                @endforeach

                <div class="last-comment collapse">

                </div>


            </div>

            <div class="col-md-9">
                <form action="{{route('comment.store')}}" method="post" id="setComment">
                    @csrf
                    <div class="form-group" id="comment-area">
                        <input type="hidden" name="post_id" value="{{$post->id}}">
                        <label for="">اضف تعليق</label>
                        <textarea name="comment" id="comment" class="form-control" style="height: 200px;resize: none;"></textarea>
                    </div>

                    <div class="form-group">
                        <button type="submit" class="btn btn-outline-success"> نشر </button>
                    </div>
                </form>

                <div class="alert alert-danger collapse error" style="display: none">

                </div>
            </div>



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
    <script>
        $(document).on('submit','#setComment',function (e) {
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
                         $('.error').hide();
                         $('.error').empty();
                     },
                     success: function () {
                            var comment = $('#comment').val();
                            var user_name= "{{auth()->user()->name}}";
                         var div = '<div class="card my-1">\n' +
                             '<div class="card-header">\n' +user_name +
                             '</div>\n' +
                             '<div class="card-body">\n' +
                             '<p class="card-text">'+comment+'</p>\n' +
                             '</div>\n' +
                             '</div>';
                         $('#comment').val('');
                         $('.last-comment').append(div);
                         $('.last-comment').show();

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
