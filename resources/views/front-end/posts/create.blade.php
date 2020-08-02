@extends('layouts.app')

@section('title')
   منشور جديد
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
    <form action="{{route('mypost.store')}}" enctype="multipart/form-data"  method="post" id="create-post">
        @csrf

        <div class="form-group">
            <label for="title">نوع المنشور</label> <br>
            <div class="btn-group" data-toggle="buttons">
                <label class="btn btn-success active">
                    عرض مساعدة
                    <input type="radio" value="1" name="post_type" id="" autocomplete="off" checked>
                </label>
                <label class="btn btn-danger">
                    طلب مساعدة
                    <input type="radio" value="0" name="post_type" id="" autocomplete="off">
                </label>
            </div>
        </div>


        <div class="form-group" dir="rtl">
            <label for="title">العنوان</label>
            <input type="text" name="title" id="title" class="form-control " placeholder="" aria-describedby="helpId" value="">
        </div>

        <div class="form-group">
            <label for="">التفاصيل</label>
            <textarea name="content" class="form-control" id="content" style="width: 100%; height: 220px; resize: none"></textarea>
        </div>

        <div class="form-group">
            <label for="categories">المحافظة</label>
            <select name="city_id" id="city_id" class="form-control city" >
                @foreach($cities as $city)
                    <option value="{{$city->id}}"> {{ $city->name }} </option>
                @endforeach
            </select>
        </div>

        <div class="form-group">
            <label for="address">العنوان بالتفصيل</label>
            <input type="text" name="address" id="address" class="form-control" placeholder="" aria-describedby="helpId">

        </div>

        <div class="form-group">
            <label for="categories">التصنيفات</label>
            <select name="categories[]" id="categories" class="form-control categories" multiple>
                @foreach($categories as $category)
                    <option value="{{$category->id}}"> {{ $category->name }} </option>
                @endforeach
            </select>
        </div>

        <div class="form-group">
            <label for="">رفع صور</label>
            <br>
            <small id="helpId" class="text-muted">اضافة صور</small>
            <input type="file" name="images[]" id="" class="form-control" placeholder="" aria-describedby="helpId" multiple>

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
        $(document).ready(function () {
        $('.city').select2();
        $('.categories').select2();
        });


// /*
         $(document).on('submit','#create-post',function (e) {
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
                            text:"تم نشر المنشور",
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
