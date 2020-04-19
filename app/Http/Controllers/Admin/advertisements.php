<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\advertisement;
use Illuminate\Http\Request;

class advertisements extends Controller
{

    public function index()
    {
        //
    }


    public function create()
    {
        return view('admin.advertisements.create');
    }

    public function store(Request $request){
        if ($request->ajax()){
            $adv = $request->validate([
                'title'=>'required|string',
                'content'=>'required|string',
                'image'=>'required|image|mimes:png,jpeg,jpg',
                'url'=>'url'

            ]);

            if ($image = $request->file('image')){

            $name = time().'-'.$image->getClientOriginalName();
            $image->move('image',$name);

        }

            $adv['image']=$name;

//            dd($adv);

          advertisement::create($adv);
            return response(['status'=>true]);
        }

    }

    public function show($id)
    {

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
}
