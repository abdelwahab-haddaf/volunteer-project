<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\City;

class cities extends Controller
{
    public function index(){
        $cities = City::paginate(10);
        return view('admin.cities.index',['cities'=>$cities]);

    }


    public function show($id){

    }

    public function create(){
        return view('admin.cities.create');
    }

    public function store(Request $request){
        if ($request->ajax()){

            $city = $request->validate([
                'name'=>'required|string|unique:cities,name',
            ]);

            City::create($city);
            return response(['status'=>true , 'data']);
        }

    }
    public function edit($id){
        $city=City::FindOrFail($id);
        return view('admin.cities.edit',['city'=>$city]);
    }
    public function update(Request $request , $id){

        if ($request->ajax()){

            $city = $request->validate([
                'name'=>'required|string|unique:cities,name',
            ]);
            City::findOrfail($id)->update($city);
            return response(['status'=>true]);

        }

    }

    public function destroy(Request $request , $id){
        if ($request->ajax()){
            City::findOrFail($id)->delete();
            return response(['status'=>true]);
        }
    }

}
