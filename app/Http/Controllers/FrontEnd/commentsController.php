<?php

namespace App\Http\Controllers\FrontEnd;

use App\Http\Controllers\Controller;
use App\Models\Comment;
use Illuminate\Http\Request;

class commentsController extends Controller
{
    public function index(){

    }

    public function create(){

    }

    public function store(Request $request)
    {
        if ($request->ajax()) {
            $request->validate([
                'comment' => 'required|string'
            ]);

            $comment = $request->all() + ['user_id' => auth()->user()->id];
            Comment::create($comment);
            return response(['status' => true, 'data']);
        }
    }

    public function edit($id){

    }

    public function update($id){

    }

//    public function show($id){
//
//    }
//
//
//    public function destroy($id){
//
//    }
}
