<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Message;
use App\Models\Post;
use App\Models\User;
Use App\Models\Category;
use Illuminate\Http\Request;

class home extends Controller
{
    public function index(){
        $last_users = User::orderBy('id','desc')->take(5)->get();
        $last_posts = Post::orderBy('id','desc')->take(5)->get();
        $users = User::all();
        $posts= Post::all();
        $messages = Message::all();
        $categories = Category::get();
        return view('admin.home',
            ['users'=>$users ,'last_users'=>$last_users , 'last_posts'=>$last_posts , 'posts'=>$posts , 'messages'=>$messages , 'categories'=>$categories]);

    }




}
