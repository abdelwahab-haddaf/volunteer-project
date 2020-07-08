@extends('layouts.app')

@section('style')

    <style>



        .content-sub-menu{
            display: none;
            position: absolute;
            background-color: #f1f1f1;
            min-width: 160px;
            box-shadow: 0px 8px 16px 0px rgba(0,0,0,0.2);
            z-index: 1;

        }

        .show-sub-menu:hover + .content-sub-menu {display: block;}

    </style>

@endsection
@section('content')
    <div class="container">
        <table class="table">
            <thead>
            <tr>
                <th>#</th>
                <th>الاسم</th>
                <th>خيارات</th>
            </tr>
            </thead>
            <tbody>
            @foreach($users as $user)
                <tr>
                    <td>{{$user->id}}</td>
                    <td>{{$user->name}}</td>
                    <td>
                        <form action="{{route('addMember',['user_id'=>$user->id ,'charity_id'=>'1'])}}" method="post" id="addMember">
                            @csrf
                            <button type="submit" class="btn btn-primary addMemberButton ">اضافة</button>

                        </form>

                    </td>


                </tr>
            @endforeach
            </tbody>
        </table>

    </div>

    @endsection

@section('js')
    <script>

        $(document).on('submit','#addMember',function (e) {
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

                        that.children('button').attr("class","btn btn-outline-danger btn-sm mt-4 removeMemberButton");
                        that.children('button').attr("id","removeMemberButton");
                        that.children('button').html('إزالة العضو');
                        that.attr("id","removeMember");
                        that.attr("action",response.url);

                        new Noty({
                            type:'success',
                            layout:'bottomCenter',
                            text:"تم اضافة عضو جديد بنجاح",
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

        $(document).on('submit','#removeMember',function (e) {
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
                            text:"تم حذف العضو بنجاح",
                            timeout:5000,
                            killer: true,
                        }).show();

                        that.children('button').attr("class","btn btn-outline-primary btn-sm mt-4 addMemberButton");
                        that.children('button').attr("id","addMemberButton");
                        that.children('button').html('اضافة عضو');
                        that.attr("id","addMember");
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


  </body>
</html>
