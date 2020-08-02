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

                <div class="col-md-3 p-4 m-3 user-info text-center">
                    @if($charity->admin->image != null)
                    <img src="{{asset('users_image/'.$charity->admin->image)}}" class="rounded-circle my-2" alt="">
                    @else
                        <img src="http://placehold.it/150" class="rounded-circle my-2" alt="">
                    @endif
                    <h4 class="my-2"> {{$charity->admin->name}}</h4>
                    @if(auth()->user()->id == $charity->user_id)
                        <form action="" method="post">
                            <button type="button" class="btn btn-danger">حذف</button>
                        </form>
                    @endif
                </div>

                @if(count($charity->user) > 0 )
                @foreach($charity->user as $user)
                <div class="col-md-3 p-4 m-3 user-info text-center">
                    @if($user->image != null)
                        <img src="{{asset('users_image/'.$user->image)}}" class="rounded-circle my-2" alt="">
                    @else
                        <img src="http://placehold.it/150" class="rounded-circle my-2" alt="">
                    @endif
                    <h4 class="my-2">{{$user->name}}</h4>
                    @if(auth()->user()->id == $charity->user_id)
                    <form action="" method="post">
                        <button type="button" class="btn btn-danger">حذف</button>
                    </form>
                        @endif
                </div>
                @endforeach
                @endif

            </div>
        </div>
        <div class="col-3 sidebar">
            <ul>
                <li><a href="" class="nav-link"> الأعضاء</a></li>
                <li><a href="" class="nav-link">المنشورات</a></li>
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
