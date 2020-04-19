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
                <th  class="text-center">المرسل</th>
                <th  class="text-center">الرسالة</th>
                <th  class="text-center">حذف</th>
            </tr>
            </thead>
            <tbody>
            @foreach($messages as $message)

                @if ($message->isRead==0)
                    <tr class="wow slideInUp">
                        <td>{{$message->id}}</td>
                        <td><a href="{{route('user.show',$message->user->id)}}"> {{$message->user->name}} </a> </td>
                        <td>
                            <a href="{{route('message.show',$message->id)}}" class="text-primary">   {{ \Illuminate\Support\Str::limit($message->message, 50, $end='...') }}</a>
                        </td>

                        <td>
                            <form action="{{route('message.destroy',$message->id)}}" method="post" id="delete">
                                @csrf
                                @method('delete')
                                <button type="submit" class="btn btn-danger btn-sm mt-4 delete">حذف</button>
                            </form>
                        </td>
                    </tr>
                @else
                <tr class="wow slideInUp" style="background-color: #c9c6c6;">
                    <td>{{$message->id}}</td>
                    <td><a href="{{route('user.show',$message->user->id)}}"> {{$message->user->name}} </a> </td>
                    <td>
                        <a href="{{route('message.show',$message->id)}}" class="text-primary" onclick="read()">   {{ \Illuminate\Support\Str::limit($message->message, 50, $end='...') }}</a>
                    </td>

                    <td>
                        <form action="{{route('message.destroy',$message->id)}}" method="post" id="delete">
                            @csrf
                            @method('delete')
                            <button type="submit" class="btn btn-danger btn-sm mt-4 delete">حذف</button>
                        </form>
                    </td>
                </tr>
                @endif
            @endforeach


            </tbody>
        </table>
    </div>

        <div class="d-flex justify-content-center">
            {{$messages->links()}}
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


        //read message
        // $('table tr a').click(function (e) {
        //     $(this).parents("tr").css("background-color", "red");
        // })


    </script>


    @endsection
