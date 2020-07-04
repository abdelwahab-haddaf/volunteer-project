<?php

namespace App\Http\Controllers\FrontEnd;

use App\Http\Controllers\Controller;
use App\Models\Messenger;
use Illuminate\Http\Request;

class Messengers extends Controller
{

    public function index()
    {
        $user_id = auth()->user()->id;
        $users = Messenger::with(['user'])->where('user_id',$user_id)->get();

        $messages = Messenger::with(['user'])->where(['user_id'=>$user_id ])->
        orWhere(['receiver_id'=>$user_id ])->get();

        return view('front-end.users.messages',['messages'=>$messages,'users'=>$users]);
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
        $users = Messenger::with(['user'])->where('user_id',$user_id)->get();

        $messages = Messenger::with(['user'])->where(['user_id'=>$user_id , 'receiver_id'=>$id])->
        orWhere(['receiver_id'=>$user_id , 'user_id'=>$id])->get();
//        dd($messages);
        return view('front-end.users.messages',['messages'=>$messages,'receiver_id'=>$id,'users'=>$users]);

    }

}
