<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;

class PostsController extends Controller
{
    public function index()
    {
        $posts = Post::paginate(3); //all
        return view('posts.index', ['posts' => $posts]);
    }

    public function store(Request $request)
    {
        $this->validate($request,[
            'body' => 'required'
        ]);

        Post::create([
            'user_id'=>auth()->user()->id,
            'body'=>$request->body
        ]);

        return redirect()->route('posts');
    }
}
