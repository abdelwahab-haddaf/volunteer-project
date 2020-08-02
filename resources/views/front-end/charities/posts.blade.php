@extends('layouts.app')

@section('title')
  {{$charity->name}}
    @endsection
@section('style')
    <style>

        .header img {
            width: 150px;
            height: 150px;
            object-fit: contain;
        }
        .user-info {
            background-color: #ddd;
        }
        .sidebar {
            background-color: #00b8d4;
        }
        .sidebar ul {
            list-style: none;
            background-color: #fff;
        }
        .sidebar ul li {
            margin: 10px;
        }
        .user-info img {
            width: 150px;
            height: 150px;
            object-fit: cover;
        }

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

@section('home')



<div class="container p-3" style="background-color: #fff">
    <div class="row">
        <div class="col-9">
            <div class="row justify-content-center">
                <div class="col-12 text-center my-2 header">
                    <h3 class="my-2">{{$charity->name}} </h3>
                    <img src="{{asset('users_image/'.$charity->image)}}" class="img-fluid rounded-circle my-2" alt="">

                    <p>
                        {{$charity->desc}}
                    </p>
                </div>

             <div class="col-12">
                 @foreach($posts as $index=>$post)
                     @php
                         if ($post->user !== null) {
                             $name = $post->user->name;
                             $image = $post->user->image;
                             }
                         elseif($post->charity != null){
                             $name = $post->charity->name;
                             $image = $post->charity->image;
                         }
                     @endphp


                     <div class="card  mb-2" dir="rtl">
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

                                         @if (isset($image))
                                             <img src="{{asset('users_image/'.$image)}}" class="img-fluid rounded-circle float-right mr-3 user-image" alt="">
                                         @else
                                             <img src="http://placehold.it/50" class="img-fluid rounded-top float-right mr-3" alt="">

                                         @endif
                                         <p class="text-right user-name"> {{$name}} </p>
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
             </div>

            </div>
        </div>
        <div class="col-3 sidebar">
            <ul>
                <li><a href="{{route('displayMembers',$charity->id)}}" class="nav-link"> الأعضاء</a></li>
                <li><a href="{{route('displayPosts',$charity->id)}}" class="nav-link">المنشورات</a></li>
                <li><a href="{{route('editFromUser',$charity->id)}}" class="nav-link">تعديل</a></li>
            </ul>


            <div class="form-group">
                <label for=""></label>
                <form action="{{route('search-name')}}" method="post" id="search-users">
                    @csrf
                    <label for="search_name">أدخل اسم للبحث</label>
                    <input type="text" name="search_name" id="search_name" class="form-control my-2" placeholder="" aria-describedby="helpId">
                    <button class="btn btn-primary" type="submit"> بحث </button>
                </form>

            </div>

            <div class="alert alert-info results collapse" id="results">
                نتيجة البحث

                <div class="row">

                </div>




            </div>

        </div>
    </div>
    @endsection



@section('js')
    <script>
        $(document).on('submit','#search-users',function (e) {
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
                    success: function (response) {
                        $('.results').show();
                        var data = "" ;
                        if(response.users.length !== 0) {
                            $.each(response.users, function () {
                                var charity_id = "{{$charity->id}}";
                                data += '<div class="col-12">' +
                                    '<form action="{{route('addMember')}}" method="post" >' +
                                    '@csrf' +
                                    '<a href="" class="nav-link float-right" >' + this.name + '</a>' +
                                    '<input type="hidden" name="user_id" value="' + this.id + '">' +
                                    '<input type="hidden" name="charity_id" value="' + charity_id + '">' +
                                    ' <button class="btn btn-primary float-left" type="submit">اضافة</button>' +
                                    ' </form>' +
                                    '</div>';
                            });
                        }
                        else {
                            data = "لا يوجد";
                        }
                            $("#results .row").html(data);

                    },

                    error: function (response , error) {
                        $('.error').show();
                        // console.table(response);
                        // console.log(error);
                        $('.error').html('');
                        $.each(response.responseJSON.errors, function(key,value) {
                            $('.error').append('<li>'+value+'</li>');
                        });
                    }

                });
        });

    </script>


@endsection


{{--
  <div class="col-md-3">
            <div class="form-group">
                <label for=""></label>
                <form action="{{route('search-name')}}" method="post" id="search-users">
                    @csrf
                    <label for="search_name">أدخل اسم للبحث</label>
                    <input type="text" name="search_name" id="search_name" class="form-control my-2" placeholder="" aria-describedby="helpId">
                    <button class="btn btn-primary" type="submit"> بحث </button>
                </form>

            </div>

            <div class="alert alert-info results collapse" id="results">
               نتيجة البحث

              <div class="row">

              </div>




            </div>

        </div>

--}}
