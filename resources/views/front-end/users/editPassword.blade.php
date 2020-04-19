@extends('layouts.app')


@section('title')
    {{$user->name}} || تعديل

@endsection


@section('content')


    <div class="container p-3" style="background-color: #fff">
        <form action="{{route('member.updatePassword',$user->id)}}" enctype="multipart/form-data"  method="post" id="update-password">
            @csrf
            @method('put')


            <div class="form-group">
                <label for=""> كلمة المرور الحالية </label>
                <input type="password" name="current_password" id="current_password" value="" class="form-control desc" placeholder=""  aria-describedby="helpId">
            </div>

                    <div class="form-group">
                        <label for=""> كلمة المرور الجديدة</label>
                        <input type="password" name="password" id="password" class="form-control " placeholder=""  aria-describedby="helpId">
                    </div>

                    <div class="form-group">
                        <label for=""> تأكيد كلمة المرور الجديدة</label>
                        <input type="password" name="password_confirmation" id="password_confirmation" class="form-control " placeholder="" aria-describedby="helpId">
                    </div>

            <div class="form-group">
                <button type="submit" class="btn btn-primary">حفظ</button>
            </div>
        </form>


{{--        <div class="alert alert-danger collapse error" style="display: none">--}}

{{--        </div>--}}
{{--        <div class="alert alert-info text-center collapse info" style="display: none">--}}

{{--        </div>--}}
    </div>
@endsection

@section('js')
    <script>

        $(document).on('submit','#update-password',function (e) {
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
                        $('.info').hide();
                        $('.info').empty();
                    },

                    success: function (response) {
                        // $('.success').html(response.message)
                        // $('.success').show();
                        var x = $('#current_password').val();
                        var y = $('#password').val();
                        if (x===y){
                            console.log('الكلمة و الجديدة متشابهين')
                        }
                        if (response.status === true) {
                            console.log(response.message);
                            $('.info').html(response.message);
                            $('.info').show();

                        }
                            else {
                            console.log(response.message);
                            $('.error').html(response.message);
                            $('.error').show();
                            }

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
