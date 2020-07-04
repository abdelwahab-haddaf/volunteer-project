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
            <div class="list-members">
                <ul style="list-style: none">
                    <li>
                        @foreach($charity->user as $user)

                            <a href="{{route('member.show',$user->id)}}" class="nav-link">{{$user->name}}</a>
                        @endforeach

                    </li>
                </ul>
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

            <div class="alert alert-info results" id="results">
                Result of search

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
