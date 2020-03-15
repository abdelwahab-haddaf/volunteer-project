<?php

namespace App\Http\Controllers;

use App\models\Image;
use App\Models\Post;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $posts = Post::orderBy('id','desc')->paginate(30);
        return view('home',['posts'=>$posts]);
    }

    public function showPost($id){
        $post = Post::findOrFail($id);
        $images = Image::where('post_id',$id)->get();

        return view('users.posts.show',['post'=>$post,'images'=>$images]);
    }
}
