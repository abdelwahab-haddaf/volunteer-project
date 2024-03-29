@extends('layouts.app')

@section('style')
    <style>

        .attatchment-images {
            display: block;
            height: 200px;
            width: 400px;
        }


        @media only screen and (max-width: 768px) {

            .attatchment-images {
                height: 200px;
                width: 170px;
                display: block;
            }

        }
    </style>
    @endsection

@section('content')

    <div class="row">
        <div class="col-6">
            <div class="form-group text-right">
                <label for=""></label>
                <h4>{{$post->title}}</h4>
                <h5>تم النشر بواسطة : <span class="text-primary"> {{$post->user->name}} </span></h5>
                <p>{{$post->content}}</p>
            </div>
        </div>
        <div class="col-6 pt-3 text-left">
            <a href="{{route('mypost.edit',$post->id)}}" class="btn btn-secondary">تعديل</a>
            <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#confirmDelete">حذف</button>
        </div>
    </div>
    {{--Modal for confirmation  --}}
    <div class="modal fade" id="confirmDelete" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">تأكيد حذف </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <p> {{\Illuminate\Support\Str::limit($post->content,100)}} </p>

                </div>
                <div class="modal-footer d-flex justify-content-start">
                    <form action="{{route('mypost.destroy',$post->id)}}" method="post">
                        @csrf
                        @method('delete')
                        <button type="submit" class="btn btn-outline-success">حذف</button>
                    </form>
                    <button type="button" class="btn btn-outline-danger" data-dismiss="modal">الغاء</button>
                </div>
            </div>
        </div>
    </div>


    <div class="form-group text-right">
        <label>المحافظة :</label>
        <label>{{$post->city->name}}</label>
        <br>
        <i class="fa fa-loction"></i>
        <label>العنوان بالتفصيل :</label>
        <label>{{$post->address}}</label>
    </div>

    @if(count($images)>0)
        <div class="form-group text-right">
            <label for="">الصور المرفقة : </label>
            <div class="row">
                @foreach($images as $image)
                    @php
                        $imagesImploded = $image->name;
                        $imagesExploded = explode('|', $imagesImploded);
                    @endphp

                    @foreach($imagesExploded as $img)
                        <div class="col-md-4">
                            <a href="{{url(asset('image/'.trim($img)))}}">
                                <img src="{{ asset('image/'.trim($img)) }}" class="img-fluid rounded-top attatchment-images" > <br>
                            </a>
                        </div>
                    @endforeach

                @endforeach
            </div>
        </div>
        <hr>
    @endif


    <div class="form-group text-right">
        <div class="row">
        @foreach($post->categories as $cat)
            <div class="col-md-3">
                <span>{{$cat->name}}</span>
            </div>
            @endforeach
           </div>
        <hr>


        <div class="row">

            <div class="col-md-9">
                @foreach($post->comments as $comment )

                    <div class="card my-1">
                        <div class="card-header">
                          {{$comment->user->name}}
                        </div>
                        <div class="card-body">
                            <p class="card-text">{{$comment->comment}}</p>
                        </div>
                    </div>

                @endforeach

                <div class="last-comment collapse">

                </div>


            </div>

            <div class="col-md-9">
                <form action="{{route('comment.store')}}" method="post" id="setComment">
                    @csrf
                    <div class="form-group">
                        <input type="hidden" name="post_id" value="{{$post->id}}">
                        <label for="">اضف تعليق</label>
                        <textarea name="comment" id="comment" class="form-control" style="height: 200px;resize: none;"></textarea>
                    </div>

                    <div class="form-group">
                        <button type="submit" class="btn btn-outline-success"> نشر </button>
                    </div>
                </form>

                <div class="alert alert-danger collapse error" style="display: none">

                </div>
            </div>



        </div>
    </div>
@endsection

@section('adv')


    <div class="card">
        <img class="card-img" src="http://placehold.it/200" alt="Card image">
        <div class="card-img-overlay">
            <p class="card-text">I'm text that has a background image!</p>
        </div>
    </div>

@endsection


@section('js')
    <script>
        $(document).on('submit','#setComment',function (e) {
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
                            var comment = $('#comment').val();
                            var user_name= "{{auth()->user()->name}}";
                         var div = '<div class="card my-1">\n' +
                             '<div class="card-header">\n' +user_name +
                             '</div>\n' +
                             '<div class="card-body">\n' +
                             '<p class="card-text">'+comment+'</p>\n' +
                             '</div>\n' +
                             '</div>';
                         $('#comment').empty();
                         $('.last-comment').append(div);
                         $('.last-comment').show();

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
