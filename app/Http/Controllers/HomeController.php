<?php

namespace App\Http\Controllers;

use App\Models\Advertisement;
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
    public function index(Request $request)
    {
        $posts = Post::with(['user', 'city'])->orderBy('id', 'desc');
        if ($request->has('search') && $request->get('search')!=''){
            $posts = $posts->where('title','like','%'.$request->search.'%')
                ->orWhere('content','like','%'.$request->search.'%');
        }

        $posts = $posts->paginate(30);
        $adv = Advertisement::orderBy('id','desc')->first();
        return view('home',['posts'=>$posts,'adv'=>$adv]);
    }

    public function showPost($id){
        $post = Post::findOrFail($id);
        $images = Image::where('post_id',$id)->get();

        return view('front-end.posts.show',['post'=>$post,'images'=>$images]);
    }


}
