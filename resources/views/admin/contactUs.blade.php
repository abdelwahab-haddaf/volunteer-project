
@extends('layouts.app')
@section('style')
    <style>
    body {
        background-color: gray;
    }
        .social-links{
            height: 400px;
            background-color: orangered;
            margin: 5px;
            border-radius: 20px;
        }

        .message-content{
            min-height: 400px;
            background-color: #ddd;
            z-index: 0;
            margin: 5px;
            border-radius: 20px;
        }

        .message-content .form-message textarea {
            resize: none;
            width: 100%;
        }
    .social-links ul li {
        list-style:none ;
    }
    .social-links ul li a {
        color: white;
    }

    </style>
    @endsection


@section('oldContact-us')

<div class="container">
<div class="row main-div d-flex align-items-center ">
    <div class="col-md-3 d-flex align-items-center justify-content-center p-2 social-links">
<div>
    <h4>إبقَ على تواصل معنا عبر :</h4>
    <ul>
        <li> <i class="fa fa-facebook"></i> <a href="" class="nav-link d-inline">فيس بوك</a></li>
        <li> <i class="fa fa-twitter"></i> <a href="" class="nav-link d-inline">تويتر</a></li>
        <li> <i class="fa fa-instagram"></i> <a href="" class="nav-link d-inline">انستغرام</a></li>
        <li> <i class="fa fa-whatsapp"></i> <a href="" class="nav-link d-inline">واتساب</a></li>
        <li> <i class="fa fa-telegram"></i> <a href="" class="nav-link d-inline">تلغرام</a></li>
    </ul>
</div>
    </div>
    <div class="col-md-8 pt-4 message-content">

        <div class="row">
            <div class="col-md-2"></div>
            <div class="col-md-9">
                <h4>أو عبر رسائل الموقع الالكتروني :</h4>

                <div class="form-message">
                    <form action="{{route('send-message')}}" method="post" id="create">
                        @csrf
                        @guest
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="">الاسم</label>
                                    <input type="text" name="name" id="" class="form-control" placeholder="" aria-describedby="helpId">
                                </div>

                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="">الايميل</label>
                                    <input type="email" name="email" id="" class="form-control" placeholder="" aria-describedby="helpId">
                                </div>
                            </div>

                        </div>


                        @endguest


                            <div class="form-group">
                                <label for="">العنوان</label>
                                <input type="text" name="title" id="" class="form-control" placeholder="" aria-describedby="helpId">
                            </div>

                        <div class="form-group">
                            <label for="">الرسالة </label>
                            <textarea class="form-control" name="message" id="" ></textarea>
                        </div>


                        <div class="form-group">
                            <button type="submit" class="btn btn-success"> إرسال</button>
                        </div>
                    </form>

                    <div class="alert alert-danger collapse error" style="display: none">

                    </div>

                </div>


            </div>

        </div>

    </div>
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
                            text:"تم ارسال الرسالة بنجاح",
                            timeout:5000,
                            killer: true,
                        }).show();

                    },
                    error: function (response , error) {
                        $('.error').show();
                        // console.table(response);
                        // console.log(error);
                        $('.error').html('');
                        $.each(response.responseJSON.errors, function(key,value) {
                            $('.error').append('<li>'+value+'</li>');
                        });
                    }

                });

        });

    </script>
    @endsection
