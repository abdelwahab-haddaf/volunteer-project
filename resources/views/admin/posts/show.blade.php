@extends('admin.layout.app')

@section('title')
   {{ $post->title}}
@endsection

@section('style')

    <style>
        .span-cat {
            display: inline !important ;
            font-size: 15px;
        }
        .row .alert{
            padding: 0 !important;
        }
    </style>
    @endsection
@section('content')

<div class="container p-3" style="background-color: #fff">

    <div class="form-group alert alert-default">
      <h3>{{$post->title}} </h3>
        <span class="text-secondary small">{{$post->created_at->format('D M Y - H:i:s')}}</span>
        <div class="m-2 p-4">
            {{$post->content}}
            <br><br><br>
            <p>
                <i class="fa fa-user"></i>
                تم النشر بواسطة <span style="display: inline" class="text-primary"> {{$post->user->name}} </span>
            </p>

            <p>
                <i class="fa fa-location-arrow"></i>
                المحافظة
                <span style="display: inline" class="text-primary"> {{$post->city->name}} </span>
                {{$post->address}}
            </p>

        </div>

        @if(count($images)>0)
        <div class="form-group">
            <label for="">الصور المرفقة </label>
            <div class="row">
            @foreach($images as $image)
                @php
                    $imagesImploded = $image->name;
                    $imagesExploded = explode('|', $imagesImploded);
                @endphp

                    @foreach($imagesExploded as $img)
                    <div class="col-md-4">
                        <a href="{{url(asset('image/'.trim($img)))}}">
                            <img src="{{ asset('image/'.trim($img)) }}" class="img-fluid rounded-top" style="display: block; height: 200px;width: 400px"> <br>
                        </a>
                    </div>
                    @endforeach

            @endforeach
            </div>
        </div>
        @endif
        <div class="row mx-3 my-3">
            <div class="col-md-12">
                <div class="row">
                    @foreach($post->categories as $cat)
                        @php
                            $color = ['success','danger','warning','primary','default','info','dark','rose','secondary'];
                        @endphp
                        {{-- <span class="alert alert-{{$color[rand(0,8)]}} span-cat" > {{$cat->name}} </span>--}}
                        <a href="" class="col-md-2 m-2 nav-link alert alert-{{$color[rand(0,8)]}} span-cat text-center " > {{$cat->name}}  </a>
                    @endforeach

                </div>
                <div class="form-group">

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

