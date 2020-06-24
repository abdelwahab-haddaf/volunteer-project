<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\models\contactUs;

class contact extends Controller
{
    public function index(){

    }

    public function show($id){

    }

    public function create(){
        return view('admin.contactUs');
    }
    public function store(Request $request){

   if($request->ajax()){
       $message = $request->validate([
           'name'=>'required|string',
           'email'=>'required|string',
           'message'=>'required|string',
       ]);

       contactUs::create($message);
       return response(['status'=>true]);
     }

    }


    public function edit($id){

    }

    public function update($id){

    }

    public function destroy($id){

    }

}
