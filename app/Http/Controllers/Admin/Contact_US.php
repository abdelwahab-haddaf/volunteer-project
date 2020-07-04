<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ContactUs;

class Contact_US extends Controller
{
    public function index(){
        $messages = ContactUs::orderBy('id','desc')->paginate(10);
        return view('admin.messages.index',['messages'=>$messages]);

    }


    public function show($id){
        $this->readMessage($id);
        $message = ContactUs::findOrFail($id);
        return view('admin.messages.show',['message'=>$message]);
    }

    public function create(){
        return view('admin.contactUs');
    }

    public function store(Request $request){
        if ($request->ajax()){


        if(auth()->user()){
            $message = $request->validate([
                'message'=>'required|string',
                'title'=>'required|string',
            ]);
            $message['name']= auth()->user()->name;
            $message['user_id']= auth()->user()->id;
            $message['email']= auth()->user()->email;
        }
        else{
            $message = $request->validate([
                'message'=>'required|string',
                'title'=>'required|string',
                'name'=>'required|string',
                'email'=>'required|email',
                'user_id'=>'nullable',
            ]);
            $message['user_id']= 0;

        }

            ContactUs::create($message);
            return response(['status'=>true , 'data']);
//            return back();
        }

    }

    public function edit($id){
        $message=ContactUs::FindOrFail($id);
        return view('admin.messages.edit',['Message'=>$message]);
    }
    public function update(Request $request , $id){

        if ($request->ajax()){

            $message = $request->validate([
                'name'=>'required|string|unique:messages,name',
                'desc'=>'required|string'
            ]);
            contact_us::findOrfail($id)->update($message);
            return response(['status'=>true]);

        }

    }

    public function destroy(Request $request , $id){
        if ($request->ajax()){
            ContactUs::findOrFail($id)->delete();
            return response(['status'=>true]);
        }
    }


    public function readMessage($id){
        $message = ContactUs::findOrFail($id);
        $message->update(['isRead'=>'0']);
    }

}
