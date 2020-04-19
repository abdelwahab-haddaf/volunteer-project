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

    public function show($id){

    }


    public function edit($id)
    {
        $post = Post::with('categories')->findOrFail($id);
        $cities= City::all();
        $categories = Category::all();
        return view('front-end.posts.edit',['post'=>$post,'cities'=>$cities,'categories'=>$categories]);
    }

    public function update(Request $request, $id)
    {
        //
    }
    public function destroy($id)
    {
        Post::findOrFail($id)->delete();
        Image::where('post_id',$id)->delete();
        DB::table('category_post')->where('post_id',$id)->delete();
        return redirect()->route('home')->with('success','تم حذف المنشور بنجاح');
    }
}
