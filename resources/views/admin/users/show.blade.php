@extends('admin.layout.app')

@section('title')
    {{$user->name}}
@endsection


@section('page_title')
    {{$user->name}}
    @endsection

@section('content')

<div class="container p-3" style="background-color: #fff">

        <div class="form-group" dir="rtl">
            <label for="">الاسم</label>
            <input type="text" name="name" id="" class="form-control name" value="{{$user->name}}" aria-describedby="helpId" readonly>
        </div>

        <div class="form-group">
            <label for="">الايميل</label>
            <input type="email" name="email" id="" class="form-control desc" value="{{$user->email}}" aria-describedby="helpId" readonly>
        </div>

        <div class="form-group">
            <label for="">نوع المستخدم </label>
            @if($user->isAdmin==0)
            <input type="text" name="email" id="" class="form-control desc" value="مستخدم عادي" aria-describedby="helpId" readonly>
            @else
            <input type="text" name="email" id="" class="form-control desc" value="مستخدم مسؤول" aria-describedby="helpId" readonly>
            @endif
        </div>

        <div class="form-group">
        <label for="">تاريخ الانضمام </label>
        <input type="text" name="email" id="" class="form-control desc" value="{{$user->created_at->format('d m y - H:i:s')}}" aria-describedby="helpId" readonly>
        </div>

</div>
    @endsection

@section('js')
    <script>

        $(document).on('submit','#create',function (e) {
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
                            text:"تم ادخال البيانات بنجاح",
                            timeout:5000,
                            killer: true,
                        }).show();

                        $('.name').val('');
                        $('.desc').val('');

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

