<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
Use App\Models\Category;

class categories extends Controller
{
    public function index(){
        $categories = Category::orderBy('id','desc')->paginate(30);
        return view('admin.categories.index',['categories'=>$categories]);

    }


    public function show($id){

    }

    public function create(){
    return view('admin.categories.create');
    }

    public function store(Request $request){
        if ($request->ajax()){

    $category = $request->validate([
        'name'=>'required|string|unique:categories,name',
        'desc'=>'required|string'
    ]);

         Category::create($category);
        return response(['status'=>true , 'data']);
        }

    }
    public function edit($id){
        $category=Category::FindOrFail($id);
        return view('admin.categories.edit',['category'=>$category]);
    }
    public function update(Request $request , $id){

        if ($request->ajax()){

            $category = $request->validate([
                'name'=>'required|string|unique:categories,name',
                'desc'=>'required|string'
            ]);
            Category::findOrfail($id)->update($category);
            return response(['status'=>true]);

        }

    }

    public function destroy(Request $request , $id){
        if ($request->ajax()){
            Category::findOrFail($id)->delete();
            return response(['status'=>true]);
        }
    }

}
