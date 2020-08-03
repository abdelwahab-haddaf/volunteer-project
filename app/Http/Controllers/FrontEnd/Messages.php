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

        $messagesReceived = Message::with(['user','user2'])->where('user_id2',auth()->user()->id)->orderBy('id','desc')->get();
        return view('front-end.users.in-messages',['messagesReceived'=>$messagesReceived]);

    }

    public function outMessages()
    {

        $messagesSent = Message::with(['user','user2'])->where('user_id',auth()->user()->id)->orderBy('id','desc')->get();
        return view('front-end.users.out-messages',['messagesSent'=>$messagesSent]);

    }


    public function create()
    {
        //
    }


    public function store(Request $request)
    {
       $data = $request->validate([
        'content'=>'required',
        'user_id2'=>'required',
        'user_id'=>'required'
        ]);
//       dd($data);
        Message::create($data);
        return back();
    }


    public function show($id)
    {
        $message = Message::findOrFail($id);
        return view('front-end.users.displayMessages',['message'=>$message]);
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
        return view('front-end.users.messages',['messages'=>$messages,'chat'=>$chat ,'chat_id' => $id]);

    }

}
