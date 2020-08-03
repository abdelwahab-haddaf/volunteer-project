@extends('layouts.app')

@section('style')
    <style>

    </style>
@endsection

@section('home')

    <div class="container mt-5">

       <div class="row">
           <div class="col-8">
               <h4 class="float-left"><a href="{{route('outMessages')}}"> ذهاب إلى الصادرة </a> </h4>
               <h4 class="float-right"><a href="{{route('messages.index')}}"> الرسائل الواردة </a> </h4>
           </div>
       </div>
        <div class="row ">
            @foreach($messagesReceived as $message)
                <div class="col-8 p-3 my-3 bg-white">
                    <h3 class="float-right">  اسم المستخدم :  {{$message->user->name}}</h3>
                    <h3 class="float-left">  وقت الارسال :  {{$message->created_at->format('d/m/y')}}</h3>

                    <br>


                    {{--                {{$message->content}}--}}
                    <p class="mt-3"><a href="{{route('messages.show',$message->id)}}"> {{\Illuminate\Support\Str::limit($message->content,100)}} </a> </p>

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
