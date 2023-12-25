<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Tag;
use App\Models\Category;

class AuthorController extends Controller
{
    public function profile($username){
        $categories = Category::all();
        $tags = Tag::all();
        $author = User::where('username',$username)->first();
        $posts = $author->posts()->approved()->published()->get();

        return view('profile',compact('posts','author','categories','tags'));
    }
}
