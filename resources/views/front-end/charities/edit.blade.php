@extends('layouts.app')

@section('title')
   انشاء جمعية جديدة
    @endsection


@section('content')

    @section('style')
        <style>

        </style>
        @endsection

<div class="container p-3" style="background-color: #fff">
    <h3>
      تعديل
        {{$charity->name}}
    </h3>
    <form action="{{route('charities.update')}}" enctype="multipart/form-data"  method="post" id="create">
        @csrf
        @method('put')
        <div class="form-group" dir="rtl">
            <label for="name">الاسم</label>
            <input type="text" name="name" id="name" class="form-control " placeholder="" aria-describedby="helpId" value="{{isset($charity) ? $charity->name : ''}}">
        </div>

        <div class="form-group">
            <label for="desc">الوصف</label>
            <textarea name="desc" class="form-control" id="desc" style="width: 100%; height: 220px; resize: none">{{isset($charity) ? $charity->desc : ''}}</textarea>
        </div>


        <div class="form-group">
            <button type="submit" class="btn btn-primary">انشاء</button>
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
                            text:"تم انشاء الجمعية بنجاح",
                            timeout:5000,
                            killer: true,
                        }).show();

                    },
                    error: function (xhr) {

                        $('.error').show();
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
