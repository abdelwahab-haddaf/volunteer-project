@extends('layouts.app')

@section('style')
    <style>

    </style>
@endsection

@section('home')

    <div class="container mt-5">

       <div class="row justify-content-center">
           <div class="col-8">
               <div class="card">
                   @php
                   if ($message->user2->id == auth()->user()->id){
                     $name = $message->user->name;
                    }
                   elseif($message->user->id == auth()->user()->id){
                       $name = $message->user2->name;
                   }
                   @endphp
                   <div class="card-header">
                       <h5 class="float-right">{{$name}} </h5>
                       <h5 class="float-left">{{$message->created_at->format('d/m/y')}}</h5>
                   </div>
                   <div class="card-body">

                       <p class="card-text">{{$message->content}}</p>
                   </div>
                   <div class="card-footer text-muted">
                       <form action="{{route('messages.store')}}" method="post">
                           @csrf
                           <div class="modal-body">
                               <div class="form-group">
                                   <textarea name="content" class="form-control message" style="resize: none; height: 80px" ></textarea>
                                   <input type="hidden" name="user_id2" value="{{$message->user2->id}}">
                                   <input type="hidden" name="user_id" value="{{auth()->user()->id}}">
                               </div>

                           </div>
                           <div class="modal-footer d-flex justify-content-start">
                               <button type="submit" class="btn btn-outline-success" >ارسال</button>
                           </div>

                       </form>
                   </div>
               </div>
           </div>
       </div>


    </div>

@endsection
