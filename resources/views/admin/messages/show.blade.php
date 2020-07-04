@extends('admin.layout.app')

@section('title')
    التصنيف | اضافة
@endsection


@section('page_title','اضافة عضو جديد')

@section('content')

<div class="container p-3" style="background-color: #fff">

        <div class="form-group" dir="rtl">
            <label for="">اسم المرسل : </label>
            @if($message->user_id ==0)
                <span class="text-info">{{$message->name}}</span>

            @else
            <span class="text-info">{{$message->user->name}}</span>
                @endif
        </div>

        <div class="form-group">
         <p>نص الرسالة :</p>

            {{$message->message}}
        </div>

        <div class="form-group">
            <label for="">تاريخ الارسال :
            <span class="text-info">{{$message->created_at->format('H:i:s - d m y')}}</span>
            </label>
        </div>


    <div class="alert alert-danger collapse error" style="display: none">

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

