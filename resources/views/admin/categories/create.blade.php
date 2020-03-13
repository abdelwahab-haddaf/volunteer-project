@extends('admin.layout.app')

@section('title')
    الأعضاء | اضافة
@endsection


@section('page_title','اضافة عضو جديد')

@section('content')

    <div class="container p-3" style="background-color: #fff">

        <form action="{{route('category.store')}}" enctype="multipart/form-data"  method="post" id="create">
            @csrf
            <div class="form-group" dir="rtl">
                <label for="">الاسم</label>
                <input type="text" name="name" id="" class="form-control name" placeholder="" aria-describedby="helpId" autofocus>
            </div>

            <div class="form-group">
                <label for="">الوصف</label>
                <input type="text" name="desc" id="" class="form-control desc" placeholder="" aria-describedby="helpId">
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

