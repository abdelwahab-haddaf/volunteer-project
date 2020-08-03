@extends('layouts.app')

@section('style')

    <style>

        .user-info {
            background-color: #ddd;
        }
        .sidebar {
            background-color: #00b8d4;
        }
        .sidebar ul {
            list-style: none;
            background-color: #fff;
        }
        .sidebar ul li {
            margin: 10px;
        }
    </style>

@endsection
@section('home')

    <div class="container mt-5">

<h3>الرسائل الصادرة</h3>
<div class="row ">
    @foreach($messagesSent as $message)
        <div class="col-8 p-3 my-3 bg-white">
            <h3 class="float-right">  اسم المستخدم :  {{$message->user2->name}}</h3>
            <h3 class="float-left">  وقت الارسال :  {{$message->created_at->format('d/m/y')}}</h3>

            <br>


{{--                {{$message->content}}--}}
            <p class="mt-3"><a href=""> {{\Illuminate\Support\Str::limit($message->content,100)}} </a> </p>

        </div>

    @endforeach

</div>


{{--
            @foreach($messagesReceived as $message)
                {{$message->content}} <br>
                {{$message->user->name}} <br>
                {{$message->user2->name}}
                <hr>
            @endforeach

            --}}
    </div>

    @endsection

@section('js')

@endsection


  </body>
</html>
