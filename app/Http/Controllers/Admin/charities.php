<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Charity;
use Illuminate\Http\Request;

class charities extends Controller
{
    public function index (){
        $charities = Charity::all();
        return view('admin.charities.index',['charities'=>$charities]);
    }

    public function show ($id){

    }

    public function create (){
    return view('admin.charities.create');
    }

    public function store(Request $request){
        if ($request->ajax()) {

            $charity = $request->validate([
                'name' => 'required|string|unique:charities,name',
                'desc' => 'required|string'
            ]);
           $charity+= ['admin_id'=>auth()->user()->id];
            Charity::create($charity);
            return response(['status'=>true , 'data']);
        }
    }

    public function edit ($id){
            $charity = Charity::findOrFail($id)->first();
            return view('admin.charities.edit',['charity'=>$charity]);
    }

    public function update(Request $request , $id){

        if ($request->ajax()){

            $charity = $request->validate([
                'name'=>'required|string|unique:charities,name,'.$id,
                'desc'=>'required|string'
            ]);
            Charity::findOrfail($id)->update($charity);
            return response(['status'=>true]);

        }

    }

    public function destroy(Request $request , $id){
        if ($request->ajax()) {
            Charity::findOrFail($id)->delete();
            return response(['status'=>true]);
        }
    }









}
