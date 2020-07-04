@extends('layouts.app')

@section('style')

    <style>



        .content-sub-menu{
            display: none;
            position: absolute;
            background-color: #f1f1f1;
            min-width: 160px;
            box-shadow: 0px 8px 16px 0px rgba(0,0,0,0.2);
            z-index: 1;

        }

        .show-sub-menu:hover + .content-sub-menu {display: block;}

    </style>

@endsection
@section('content')
    <div class="container">
        <div class="form-group">
            <label for=""></label>
            <form action="{{route('search-name')}}" method="post" id="search-users">
                @csrf
                <input type="text" name="search_name" id="" class="form-control my-2" placeholder="" aria-describedby="helpId">
                <button class="btn btn-primary" type="submit"> بحث </button>
            </form>

        </div>

        <div class="alert alert-info results" id="results">
            Result of search

        </div>

        <div class="alert alert-danger collapse error" style="display: none">

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


  </body>
</html>
