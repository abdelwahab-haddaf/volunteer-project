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

    <div class="container charity mt-5">
      @foreach($charity->user as $user)
          {{$user->name}}
        @if($user->user != null)
          {{$user->user->phone}}
            @endif
        @endforeach
    </div>

    @endsection

@section('js')

@endsection


  </body>
</html>
