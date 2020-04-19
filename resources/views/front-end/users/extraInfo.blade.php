@extends('layouts.app')


@section('title')
    {{$user->name}} || تعديل

    @endsection


@section('content')


<div class="container p-3" style="background-color: #fff">
    <form action="{{route('member.update',$user->id)}}" enctype="multipart/form-data"  method="post" id="update-user">
        @csrf
        @method('put')
        <div class="form-group">
            <label for="">التخصص :</label>
            <input type="text" name="study" id="" class="form-control " placeholder=""  autofocus>
        </div>

        <div class="form-group">
            <label for="">مكان الإقامة :</label>
            <input type="text" name="address" id="" class="form-control " placeholder=""  >
        </div>


        <div class="form-group">
            <label for=""> المهارات :</label>
            <input type="text" name="skills" value="" class="form-control desc" placeholder=""  aria-describedby="helpId">
            <small id="helpId" class="text-muted">ادخل مهاراتك مفصولة بـ(-) بين كل مهارة و أخرى</small>

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

        $(document).on('submit','#update-user',function (e) {
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
