<?php

namespace App\Http\Controllers\frontEnd;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\City;
use App\models\Image;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class postsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }


    public function create(){
        $cities= City::all();
        $categories = Category::all();
        return view('front-end.posts.create',['cities'=>$cities,'categories'=>$categories]);
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

    public function show($id){

    }


    public function edit($id)
    {
        $post = Post::with('categories','user')->findOrFail($id);
        $cities= City::all();
        $categories = Category::all();
//        return view('front-end.posts.edit',['post'=>$post,'cities'=>$cities,'categories'=>$categories]);

        if ($post->user_id==auth()->user()->id){
            return view('front-end.posts.edit',['post'=>$post,'cities'=>$cities,'categories'=>$categories]);
        }
        else{
            return back();
        }

    }


    public function update(Request $request, $id)
    {
        if ($request->ajax()){
        $post = $request->validate([
            'title'=>'required|string',
            'content'=>'required|string',
            'address'=>'required|string',
            'city_id'=>'required|integer',
            'post_type'=>'required|integer',

        ]);
        $post = ['user_id'=>auth()->user()->id]+$post;
        $post1= Post::findOrfail($id);
        $post1->update($post);
        $post1->categories()->sync($request->categories);

        $images=array();
        if ($files = $request->file('images')){
            foreach($files as $file){
                $name = $file->getClientOriginalName().'_'.time().'.'.$file->getClientOriginalExtension();
                $file->move('image',$name);
                $images[]=$name;
            }

            Image::where('post_id',$post->id)->update([
                'name'=>implode("|",$images),
                'post_id'=>$post->id,
                'created_at'=>now(),
                'updated_at'=>now(),
            ]);
        }

            return response(['status'=>true]);
        }
    }
    public function destroy($id)
    {
        Post::findOrFail($id)->delete();
        Image::where('post_id',$id)->delete();
        DB::table('category_post')->where('post_id',$id)->delete();
        return redirect()->route('home')->with('success','تم حذف المنشور بنجاح');
    }
}
