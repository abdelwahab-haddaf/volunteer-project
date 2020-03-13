@extends('admin.layout.app')


@section('title')
    المنشورات | تعديل
    @endsection

@section('page_title')
تعديل منشور
@endsection

@section('content')


<div class="container p-3" style="background-color: #fff">
    <form action="{{route('post.update',$post->id)}}" enctype="multipart/form-data"  method="post" id="update-post">
        @csrf
        @method('put')
        <div class="form-group" dir="rtl">
            <label for="">العنوان</label>
            <input type="text" name="name" id="" class="form-control " placeholder="" aria-describedby="helpId" value="{{$post->title}}" autofocus>
        </div>

        <div class="form-group">
            <label for="">التفاصيل</label>
            <input type="email" name="email" id="" class="form-control " placeholder="" value="{{$post->content}}" aria-describedby="helpId">
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

        $(document).on('submit','#update-post',function (e) {
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
                            text:"تم تعديل البيانات بنجاح",
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


    </script>


@endsection
