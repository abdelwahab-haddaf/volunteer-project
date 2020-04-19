@extends('layouts.app')


@section('title')
    {{$user->name}} || تعديل

    @endsection


@section('content')


<div class="container p-3" style="background-color: #fff">
    <form action="{{route('member.update',auth()->user()->id)}}" enctype="multipart/form-data"  method="post" id="update-user">
        @csrf
        @method('put')
        <div class="form-group" dir="rtl">
            <label for="">الاسم</label>
            <input type="text" name="name" id="" class="form-control " placeholder="" aria-describedby="helpId" value="{{$user->name}}" autofocus>
        </div>

        <div class="form-group">
            <label for="">الايميل</label>
            <input type="email" name="email" id="" class="form-control " placeholder="" value="{{$user->email}}" aria-describedby="helpId">
        </div>


        <div class="form-group">
            <label for=""> كلمة المرور الحالية </label>
            <input type="password" name="current_password" value="" class="form-control desc" placeholder=""  aria-describedby="helpId">
        </div>

        <div class="form-group">
            <button type="submit" class="btn btn-primary">حفظ</button>
        </div>
    </form>
    <a href="#extra-info" class="nav-link " data-toggle="collapse"> معلومات اضافية </a>
    <form action="{{route('member.updateExtra',auth()->user()->id)}}" id="extra-info" class="collapse" method="post" enctype="multipart/form-data">
        @csrf
        <div class="form-group">
            <label for="">الصورة الشخصية</label>
            <input type="file" class="form-control-file" name="profile_image" id="image" placeholder="" aria-describedby="fileHelpId">
            <small id="fileHelpId" class="form-text text-muted">الصورة الشخصية يجب ان تكون من نوع jpeg,jpg,png</small>
        </div>

        <div class="form-group">
            <label for="">نبذة عن نفسك</label>
                <textarea name="bio" class="form-control p-2" style=" width:100% ; height: 150px;resize: none" autofocus>{{isset($extra)? $extra->bio : ''}} {{old('bio')}} </textarea>
        </div>


        <div class="form-group">
            <label for="">التخصص :</label>
            <input type="text" name="study" id="" class="form-control " value="{{isset($extra)? $extra->study : ''}} {{old('study')}}"  >
        </div>

        <div class="form-group">
            <label for="">مكان الإقامة :</label>
            <input type="text" name="address" id="" class="form-control " value="{{isset($extra)? $extra->address : ''}} {{old('address')}}"  >
        </div>

        <div class="form-group">
            <label for="">رقم الهاتف</label>
            <input type="text" name="phone" id="" class="form-control " value="{{isset($extra)? $extra->phone : ''}} {{old('phone')}}"  >
        </div>


        <div class="form-group">
            <label for=""> المهارات :</label>
            <input type="text" name="skills" class="form-control desc" value="{{isset($extra)? $extra->skills : ''}} {{old('skills')}}"  aria-describedby="helpId">
            <small id="helpId" class="text-muted">ادخل مهاراتك مفصولة بـ(-) بين كل مهارة و أخرى</small>

        </div>

        <div class="form-group">
            <button type="submit" class="btn btn-primary">حفظ</button>
        </div>

    </form>

{{--    <div class="alert alert-danger collapse error" style="display: none">--}}

{{--    </div>--}}
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
                        $('.info').hide();
                        $('.info').empty();
                    },
                    success: function (response) {

                        if (response.status === true) {
                            console.log(response.message);
                            $('.info').html(response.message);
                            $('.info').show();

                        }
                        else {
                            console.log(response.message);
                            $('.error').append(response.message);
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
