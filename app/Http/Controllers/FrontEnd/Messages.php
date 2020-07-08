<?php

namespace App\Http\Controllers\FrontEnd;

use App\Http\Controllers\Controller;
use App\Models\Chat;
use App\Models\Message;

use Illuminate\Http\Request;

class Messages extends Controller
{

    public function index()
    {
        $user_id = auth()->user()->id;
        $messages = Message::with(['user','chat'])->where('user_id',$user_id)->get();
         $chat = Chat::with(['user1','user2'])->where('user_id',$user_id)->orWhere('user_id2',$user_id)->get();
//        dd($chat);
         return view('front-end.users.messages',['messages'=>$messages,'chat'=>$chat]);

    }


    public function create()
    {
        //
    }


    public function store(Request $request)
    {
        //
    }


    public function show($id)
    {
        //
    }


    public function edit($id)
    {
        //
    }


    public function update(Request $request, $id)
    {
        //
    }


    public function destroy($id)
    {
        //
    }


    public function getMessages($id){
        $user_id = auth()->user()->id;

        $chat = Chat::with(['user1','user2'])->where('user_id',$user_id)->orWhere('user_id2',$user_id)->get();

        $user_id = auth()->user()->id;

        $messages = Message::with(['user'])->where('user_id',$user_id)->get();
//        dd($messages);
        return view('front-end.users.messages',['messages'=>$messages,'chat'=>$chat]);

    }

}
