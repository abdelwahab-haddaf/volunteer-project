<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Charity;
use App\Models\City;
use App\Models\Post;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class charities extends Controller
{
    public function index()
    {
        $charities = Charity::all();
        return view('admin.charities.index', ['charities' => $charities]);
    }

    public function show($id)
    {

        $charity = Charity::with(['user', 'admin'])->findOrFail($id);
        $cities= City::all();
        $categories = Category::all();
//        return view('empty', ['charity' => $charity]);
        return view('front-end.charities.show', ['charity' => $charity ,'cities'=>$cities , 'categories'=>$categories]);

    }

    public function displayMembers($id)
    {

        $charity = Charity::with(['user', 'admin'])->findOrFail($id);

        return view('front-end.charities.members', ['charity' => $charity]);

    }

    public function displayPosts($id){
        $charity = Charity::with(['user', 'admin'])->findOrFail($id);
        $posts = Post::with(['user','charity', 'city'])->where('charity_id',$id)->orderBy('id', 'desc')->get();
//       dd($posts);
        return view('front-end.charities.posts',['posts'=>$posts,'charity'=>$charity]);
    }

    public function create()
    {
        return view('admin.charities.create');
    }

    public function store(Request $request){

//        dd($request);

       if ($request->ajax()) {

            $charity = $request->validate([
                'name' => 'required|string|unique:charities,name',
                'desc' => 'required|string',
                'image'=>'nullable|image|mimes:jpg,jpeg,png|max:4096',
            ]);
           if ($image = $request->file('image')){
               $imageName = time().'-'.$image->getClientOriginalName();
               $image->move('users_image',$imageName);
               $charity['image'] =$imageName ;
           }
            $charity += ['user_id' => auth()->user()->id];
            Charity::create($charity);
            return response(['status' => true, 'data']);
        }

        }

    public function edit($id)
    {
        $charity = Charity::findOrFail($id);
        return view('admin.charities.edit', ['charity' => $charity]);
    }

    public function update(Request $request, $id)
    {

        if ($request->ajax()) {

            $charity = $request->validate([
                'name' => 'required|string|unique:charities,name,' . $id,
                'desc' => 'required|string',
                'image'=>'nullable|image|mimes:jpg,jpeg,png|max:4096',
            ]);

            if ($image = $request->file('image')){
                $imageName = time().'-'.$image->getClientOriginalName();
                $image->move('users_image',$imageName);
                $charity['image'] =$imageName ;
            }
            Charity::findOrfail($id)->update($charity);
            return response(['status' => true]);

        }

    }

    public function editFromUser($id)
    {
        $charity = Charity::findOrFail($id);
        return view('front-end.charities.edit', ['charity' => $charity]);
    }

    public function updateFromUser(Request $request , $id){
        if ($request->ajax()) {

            $charity = $request->validate([
                'name' => 'required|string|unique:charities,name,' . $id,
                'desc' => 'required|string',
                'image'=>'nullable|image|mimes:jpg,jpeg,png|max:4096',
            ]);
            Charity::findOrfail($id)->update($charity);
            return response(['status' => true]);

        }
    }

    public function destroy(Request $request, $id)
    {
        if ($request->ajax()) {
            Charity::findOrFail($id)->delete();
            return response(['status' => true]);
        }
    }


    public function search(Request $request)
    {
        if ($request->ajax()) {
            $users = $request->validate([
                'search_name'=>'required|string',
            ]);
            if ($request->search_name != null) {

                $users = User::where('name', 'like', '%' . $request->search_name . '%')->get();
                return response()->json(['status'=>true ,'users' => $users]);

            }
        }

    }

    public function addMember(Request $request)
    {
//        dd($request);

//       if ($request->ajax()) {

            $charity = DB::table('charity_user')->insert([
                'charity_id' =>  request('charity_id'),
                'user_id' => request('user_id'),
                'created_at' => now(),
                'updated_at' => now(),
            ]);

        return back();
//            return response(['status' => true,'url'=>$url]);

//        }
    }

    public function removeMember(Request $request , $user_id, $charity_id)
    {

        if ($request->ajax()) {
//            $users = DB::table('charity_user')->get(['user_id', 'charity_id']);

            $charity = DB::table('charity_user')->where(['user_id'=>$user_id,'charity_id'=>$charity_id])->delete();
            $url = route('addMember',$user_id);
            return response(['status' => true,'url'=>$url]);

        }
    }


}
