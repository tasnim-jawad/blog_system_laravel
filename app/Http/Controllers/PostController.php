<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use Illuminate\Support\Facades\Session;
use App\Models\Tag;
use App\Models\Category;

class PostController extends Controller
{
    public function index(){
        $posts = Post::latest()->paginate(6);
        return view('posts',compact('posts'));
    }

    public function details($slug){
        $post = Post::where('slug',$slug)->first();

        $blogKey = 'blog_'. $post->id;
        if(!Session::has($blogKey)){
            $post->increment('view_count');
            Session::put($blogKey,1);
        }
        $rendomPosts = Post::all()->random(3);
        return view('post',compact('post','rendomPosts'));
    }

    public function postByCategory($slug){
        $category = Category::where('slug',$slug)->first();
        return view('category_posts',compact('category'));
    }

    public function postByTag($slug){
        $tag = Tag::where('slug',$slug)->first();
        return view('tag_posts',compact('tag'));
    }
}
