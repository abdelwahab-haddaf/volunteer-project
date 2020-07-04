@extends('layouts.app')

@section('style')
    <style>
        .users-list,.message-content {
            height: 500px;
            overflow-x: hidden;
            overflow-y: scroll;;
        }
        .message-content {
            height: 358px;
        }
        .message-form textarea{
            resize: none;
            width: 90%;
            height: 62px;
        }
        .user {
            border-bottom: 0 !important;
        }
        .user:last-of-type{
            border-bottom: 1px solid #dee2e6!important;
        }
        .message-content p {
            display: block;
            width: 60%;
        }
        .message-content p span  {
            border-radius: 25px;
        }
    </style>
@endsection

@section('home')

    <div class="container mt-5">
        <div class="messages-list">
            <div class="row">
                <div class="col-3 users-list p-0 border">


                    @foreach($messages as $message)
                        <div class=" border p-1 user text-right">
                            <a href="{{route('getMessages',$message->receiver_id)}}">

                                <img src="http://placehold.it/40" alt="" class="rounded-circle">
                                <span class="m-1 mb-0">
                        {{$message->user->name}}
                        </span>
                                <span class="mx-2 text-secondary float-left">time</span>
                            </a>
                        </div>
                    @endforeach



                </div>
                <div class="col-8 p-0 border">
                    <div class="message-content p-0">

                        @if(isset($messages) > 0)
                        <div class="user-name text-center bg-secondary p-2 ">
                        اسم المستخدم
                        </div>

                        @foreach($messages as $message)
                            @if(isset($receiver_id))
                            @if($message->user_id == auth()->user()->id && $message->receiver_id== $receiver_id )
                                <p class="float-left m-2 text-left">
                       <span class="bg-info text-white p-2">
                            {{$message->message_content}}
                       </span>
                                </p>
                            @elseif($message->receiver_id == auth()->user()->id && $message->user_id == $receiver_id)
                                <p class="float-right m-2  text-right ">
                           <span class="bg-light p-2">
                                {{$message->message_content}}
                           </span>
                                </p>
                            @endif
                            @endif

                        @endforeach

                        @else
                            <div class="user-name text-center bg-secondary p-2 ">
                            لا توجد رسائل
                            </div>
                        @endif

                    </div>
                    <form action="">
                        <div class="form-group justify-content-center message-form ">
                            <label for="message-text"></label>
                            <textarea name="message-text" id="message-text" class="form-control mr-4 message-text" ></textarea>
                            <button type="submit" class="btn btn-primary float-right mt-2 mr-4"> ارسال</button>
                        </div>
                    </form>
                </div>

            </div>
        </div>
    </div>
@endsection
