<?php

namespace App\Http\Controllers\FrontEnd;

use App\Http\Controllers\Controller;
use App\Models\Chat;
use App\Models\Message;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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


        if (\request()->has('message_content')){
            Message::create(['chat_id'=>$id, 'content'=>request()->message_content, 'user_id'=>$user_id]);
        }

        $chat = Chat::with(['user1','user2'])->where('user_id',$user_id)->orWhere('user_id2',$user_id)->get();
        $chat_selected = $chat->where('id',$id)->first();

        $user_id = auth()->user()->id;

        $messages = $chat_selected->message ; //Message::with(['user'])->where('user_id',$user_id)->get();
        return view('front-end.users.messages',['messages'=>$messages,'chat'=>$chat]);

    }

}
