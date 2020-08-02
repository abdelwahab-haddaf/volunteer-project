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
                   <form action="{{route('mypost.store')}}" enctype="multipart/form-data"  method="post" id="create-post">
                       @csrf
                       <input type="hidden" name="post_type" value="1">
                       <input type="hidden" name="charity_id" value="{{$charity->id}}">
                       <div class="form-group">
                           <label for="title">نوع المنشور</label> <br>
                           <div class="btn-group" data-toggle="buttons">
                               <label class="btn btn-success active">
                                   عرض مساعدة
                                   <input type="radio" value="1" name="post_type" id="" autocomplete="off" checked>
                               </label>
                               <label class="btn btn-danger">
                                   طلب مساعدة
                                   <input type="radio" value="0" name="post_type" id="" autocomplete="off">
                               </label>
                           </div>
                       </div>


                       <div class="form-group" dir="rtl">
                           <label for="title">العنوان</label>
                           <input type="text" name="title" id="title" class="form-control " placeholder="" aria-describedby="helpId" value="">
                       </div>

                       <div class="form-group">
                           <label for="">التفاصيل</label>
                           <textarea name="content" class="form-control" id="content" style="width: 100%; height: 220px; resize: none"></textarea>
                       </div>

                       <div class="form-group">
                           <label for="categories">المحافظة</label>
                           <select name="city_id" id="city_id" class="form-control city" >
                               @foreach($cities as $city)
                                   <option value="{{$city->id}}"> {{ $city->name }} </option>
                               @endforeach
                           </select>
                       </div>

                       <div class="form-group">
                           <label for="address">العنوان بالتفصيل</label>
                           <input type="text" name="address" id="address" class="form-control" placeholder="" aria-describedby="helpId">

                       </div>

                       <div class="form-group">
                           <label for="categories">التصنيفات</label>
                           <select name="categories[]" id="categories" class="form-control categories" multiple>
                               @foreach($categories as $category)
                                   <option value="{{$category->id}}"> {{ $category->name }} </option>
                               @endforeach
                           </select>
                       </div>

                       <div class="form-group">
                           <label for="">رفع صور</label>
                           <br>
                           <small id="helpId" class="text-muted">اضافة صور</small>
                           <input type="file" name="images[]" id="" class="form-control" placeholder="" aria-describedby="helpId" multiple>

                       </div>


                       <div class="form-group">
                           <button type="submit" class="btn btn-primary">حفظ</button>
                       </div>
                   </form>

                   <div class="alert alert-danger collapse error" style="display: none">

                   </div>

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
    @endsection



@section('js')
    <script>

        $(document).ready(function () {
            $('.city').select2();
            $('.categories').select2();
        });

        $(document).on('submit','#create-post',function (e) {
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

                        new Noty({
                            type:'success',
                            layout:'bottomCenter',
                            text:"تم نشر المنشور",
                            timeout:5000,
                            killer: true,
                        }).show();

                    },
                    error: function (xhr) {

                        $('.error').show();
                        console.log((xhr.responseJSON.error));
                        $('.error').html('');

                        $.each(xhr.responseJSON.errors, function(key,value) {
                            $('.error').append('<li>'+value+'</li>');
                        });
                    }

                });

        });

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
