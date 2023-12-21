<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;

class PostController extends Controller
{
    public function index(){
        $posts = Post::latest()->paginate(6);
        return view('posts',compact('posts'));
    }

    public function details($slug){
        $post = Post::where('slug',$slug)->first();
        $rendomPosts = Post::all()->random(3);
        return view('post',compact('post','rendomPosts'));
    }
}
