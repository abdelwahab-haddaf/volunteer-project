@extends('admin.layout.app')

@section('page_title','قائمة الأعضاء');
@section('style')
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.20/css/jquery.dataTables.min.css">
    <style>
        .dataTables_info{
            display: none;
        }
    </style>
    @endsection
@section('content')

<div class="container" style="background-color: #fff">
    <div class="form-group">
        <table class="table table-hover table-bordered text-center users_table">
            <thead>
            <tr>
                <th  class="text-center">الرقم</th>
                <th  class="text-center">الاسم</th>
                <th  class="text-center">الايميل</th>
                <th  class="text-center">تعديل</th>
                <th  class="text-center">حذف</th>
            </tr>
            </thead>
            <tbody>
            @foreach($users as $user)
                <tr class="">
                    <td>{{$user->id}}</td>
                    <td><a href="{{route('user.show',$user->id)}}" class="nav-link">{{$user->name}}</a> </td>
                    <td>{{$user->email}}</td>
                    <td>
                        @if($user->isAdmin==0)
                        <form action="{{route('user.setAdmin',$user->id)}}" method="post" id="setAdmin">
                            @csrf
                            <button type="submit" class="btn btn-outline-primary btn-sm mt-4 setAdminButton" id="setAdminButton">تعيين كمسؤول</button>
                        </form>
                        @else

                            <form action="{{route('user.removeAdmin',$user->id)}}" method="post" id="removeAdmin">
                                @csrf
                                <button type="submit" class="btn btn-outline-danger btn-sm mt-4 removeAdminButton" id="removeAdminButton">إزالة مسؤول</button>
                            </form>
                        @endif
                    </td>


                </tr>
            @endforeach


            </tbody>
        </table>
    </div>

        <div class="d-flex justify-content-center">
            {{$users->links()}}
        </div>



    <div class="alert alert-danger collapse error" style="display: none">

    </div>

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
                            that.parents("tr").remove();
                        }),
                        Noty.button('لا','btn btn-success m-2',function () {
                            n.close();
                        })
                    ]
                });
                n.show();

            });


            $(document).on('submit','#delete',function (e) {
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
                            $(this).parent("tr").remove();
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

            $(document).ready(function () {
                $('.users_table').DataTable({
                    "paging":   false,
                    "ordering": false,
                    "info":     false,
                });

                $('.dataTables_wrapper  .row div').first().remove();
            })

            $(document).on('submit','#setAdmin',function (e) {
                e.preventDefault();
                var that = $(this);
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
                        //success when set new admin
                        success: function (response) {

                            that.children('button').attr("class","btn btn-outline-danger btn-sm mt-4 removeAdminButton");
                            that.children('button').attr("id","removeAdminButton");
                            that.children('button').html('إزالة مسؤول');
                            that.attr("id","removeAdmin");
                            that.attr("action",response.url);

                            new Noty({
                                type:'success',
                                layout:'bottomCenter',
                                text:"تم تعيين مسؤول جديد بنجاح",
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

            $(document).on('submit','#removeAdmin',function (e) {
                e.preventDefault();
                var that = $(this);
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

                            new Noty({
                                type:'success',
                                layout:'bottomCenter',
                                text:"تم حذف المسؤول بنجاح",
                                timeout:5000,
                                killer: true,
                            }).show();

                            that.children('button').attr("class","btn btn-outline-primary btn-sm mt-4 setAdminButton");
                            that.children('button').attr("id","setAdminButton");
                            that.children('button').html('تعيين  مسؤول');
                            that.attr("id","setAdmin");
                            that.attr("action",response.url);
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
