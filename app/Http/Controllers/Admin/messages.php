<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Message;

class messages extends Controller
{
    public function index(){
        $messages = Message::with('userWhoSentMessage','userWhoReceivedMessage')->paginate(10);
        return view('admin.messages.index',['messages'=>$messages]);

    }


    public function show($id){

    }

    public function create(){
        return view('admin.messages.create');
    }

    public function store(Request $request){
        if ($request->ajax()){

            $Message = $request->validate([
                'name'=>'required|string|unique:messages,name',
                'desc'=>'required|string'
            ]);

            Message::create($Message);
            return response(['status'=>true , 'data']);
        }

    }

    public function edit($id){
        $Message=Message::FindOrFail($id);
        return view('admin.messages.edit',['Message'=>$Message]);
    }
    public function update(Request $request , $id){

        if ($request->ajax()){

            $Message = $request->validate([
                'name'=>'required|string|unique:messages,name',
                'desc'=>'required|string'
            ]);
            Message::findOrfail($id)->update($Message);
            return response(['status'=>true]);

        }

    }

    public function destroy(Request $request , $id){
        if ($request->ajax()){
            Message::findOrFail($id)->delete();
            return response(['status'=>true]);
        }
    }

}
