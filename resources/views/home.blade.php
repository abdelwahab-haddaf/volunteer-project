@extends('layouts.app')

@section('content')
    @foreach($posts as $post)
    <div class="card m-3 text-right text-primary">
        @if($post->post_type==1)
            <a href="{{route('front.showPost',['id'=>$post->id ,'slug'=>str_replace(" ","_",$post->title)])}}">
        <div class="card-header alert alert-danger">{{$post->title}}</div>
            </a>
        @else
            <a href="{{route('front.showPost',['id'=>$post->id ,'slug'=>str_replace(" ","_",$post->title)])}}">
            <div class="card-header alert alert-success">{{$post->title}}</div>
            </a>
        @endif
        <div class="card-body p-0">

                <div class="alert alert-default" role="alert">
                <p> {{\Illuminate\Support\Str::limit($post->content,100)}} </p>
                </div>

        </div>
    </div>


    @endforeach
    <div class="d-flex justify-content-center">
        {{$posts->links()}}
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
