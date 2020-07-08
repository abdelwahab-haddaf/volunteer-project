@extends('layouts.app')

@section('title')
  {{$charity->name}}
    @endsection
@section('style')
    <style>

    </style>
@endsection

@section('home')



<div class="container p-3" style="background-color: #fff">
    <h3>
    {{$charity->name}}
    </h3>
    <div class="row">
        <div class="col-md-8">
          <div class="row">
              <div class="col-md-8">
                  <div class="desc" style="padding-right: 40px;">
                      <p>عن الجمعية</p>
                      <p> {{$charity->desc}} </p>
                  </div>
                  <div class="list-members">
                      <ul style="list-style: none">
                          <li>
                              <label class="d-inline">مدير الجمعية :</label>
                              <a href="{{route('member.show',$charity->admin->id)}}" class="nav-link d-inline">{{$charity->admin->name}}</a>

                          </li>

                          <span> قائمة الأعضاء : </span>
                          <li>
                              @foreach($charity->user as $user)

                                  <a href="{{route('member.show',$user->id)}}" class="nav-link d-inline-block">{{$user->name}}</a>
                              @endforeach

                          </li>
                      </ul>
                  </div>
              </div>
              <div class="col-md-4">
                  <img src="http://placehold.it/200" class="img-fluid rounded-top" alt="">
              </div>
          </div>

        </div>
        <div class="col-md-3">
            <div class="form-group">
                <label for=""></label>
                <form action="{{route('search-name')}}" method="post" id="search-users">
                    @csrf
                    <label for="search_name">أدخل اسم للبحث</label>
                    <input type="text" name="search_name" id="search_name" class="form-control my-2" placeholder="" aria-describedby="helpId">
                    <button class="btn btn-primary" type="submit"> بحث </button>
                </form>

            </div>

            <div class="alert alert-info results collapse" id="results">
               نتيجة البحث

            </div>

        </div>
</div>
    @endsection



@section('js')
    <script>
        $(document).on('submit','#search-users',function (e) {
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
                    success: function (response) {
                        $('.results').show();
                        var data = "" ;
                        $.each(response.users , function () {
                            data+= '<div value=" '+this.id+'">' + this.name + '</div>';
                        });

                        $("#results").html(data);

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
