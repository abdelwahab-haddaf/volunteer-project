@extends('admin.layout.app')


@section('title')
    الاعلانات | انشاء
    @endsection

@section('page_title')
انشاء اعلان
@endsection

@section('content')

    @section('style')
        <style>
            .form-group input[type=file]{
                z-index: 0;
                opacity: 1;
            }
        </style>
        @endsection

<div class="container p-3" style="background-color: #fff">
    <form action="{{route('advertisement.store')}}" enctype="multipart/form-data"  method="post" id="create-advertisement">
        @csrf
        @method('post')
        <div class="form-group" dir="rtl">
            <label for="title">العنوان</label>
            <input type="text" name="title" id="title" class="form-control " placeholder="" aria-describedby="helpId" value="">
        </div>

        <div class="form-group">
            <label for="">التفاصيل</label>
            <textarea name="content" class="form-control" id="content" style="width: 100%; height: 220px; resize: none"></textarea>
        </div>

        <div class="form-group" dir="rtl">
            <label for="title">الرابط</label>
            <input type="url" name="url" id="title" class="form-control " placeholder="" aria-describedby="helpId" value="">
        </div>

        <div class="form-group">
            <label for="">رفع صور</label>
            <br>
            <small id="helpId" class="text-muted">اضافة صور</small>
            <input type="file" name="image" id="" class="form-control" placeholder="" aria-describedby="helpId">

        </div>


        <div class="form-group">
            <button type="submit" class="btn btn-primary">حفظ</button>
        </div>
    </form>

    <div class="alert alert-danger collapse error" style="display: none">

    </div>
</div>
    @endsection

@section('js')
    <script>

         $(document).on('submit','#create-advertisement',function (e) {
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
 // */

    </script>


@endsection
