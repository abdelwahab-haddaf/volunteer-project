<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\City;
use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\Image;
use Illuminate\Support\Facades\DB;

class posts extends Controller
{
    public function index(){
        $posts = Post::paginate(10);
        return view('admin.posts.index',['posts'=>$posts]);
    }

    public function show($id){
        $post = Post::findOrFail($id);
        $images = Image::where('post_id',$id)->get();
//        dd($images);
        return view('admin.posts.show',['post'=>$post,'images'=>$images]);
    }

    public function create(){
        $cities = City::all();
        $categories = Category::all();
        return view('admin.posts.create',['cities'=>$cities,'categories'=>$categories]);
    }

    public function store(Request $request){
        if ($request->ajax()){
        $post = $request->validate([
            'title'=>'required|string',
            'content'=>'required|string',
            'address'=>'required|string',
            'city_id'=>'required|integer',
            'post_type'=>'required|integer',

        ]);

        $post = ['user_id'=>auth()->user()->id]+$post;
        $post=  Post::create($post);
        $post->categories()->sync($request->categories);


            $images=array();
            if ($files = $request->file('images')){
                foreach($files as $file){
                    $name = $file->getClientOriginalName().'_'.time().'.'.$file->getClientOriginalExtension();
                    $file->move('image',$name);
                    $images[]=$name;
                }

                Image::insert([
                   'name'=>implode("|",$images),
                   'post_id'=>$post->id,
                   'created_at'=>now(),
                   'updated_at'=>now(),
                ]);
        }

        ////////////end here

//        dd($post);
            return response(['status'=>true]);
        }

    }


    public function edit($id){

        $post=post::FindOrFail($id);
        return view('admin.posts.edit',['post'=>$post]);
    }
    public function update(Request $request , $id){

        if ($request->ajax()) {
            $data =  post::where('id',$id)->first();
            $post = $request->validate([
                'name' => 'required|string',
                'email'=>'required|unique:posts,email,'.$id,
                'password' => 'required|confirmed|string|min:8',
                'password_confirmation' => 'required|string',
                'current_password' => 'required',
            ]);
            $post['password'] = bcrypt(\request('password'));
            if (Hash::check($post['current_password'],$data['password'])){
                post::findOrFail($id)->update($post);
                return response(['status' => true]);

            }
            else{
//                    return session('error','خطأ في كلمة المرور');
//                    session('error','كلمة المرور الحالية خاطئة');
//                    return response(['status' => false ,'message'=>'خطأ في كلمة المرور الحالية']);
            }

        }
    }
    public function destroy(Request $request , $id){
        if ($request->ajax()){
            post::findOrFail($id)->delete();
            Image::where('post_id',$id)->delete();
            DB::table('category_post')->where('post_id',$id)->delete();
            return response(['status'=>true]);
        }
    }


}
