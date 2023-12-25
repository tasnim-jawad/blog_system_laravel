<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\Tag;
use App\Models\Category;
use App\Models\User;
use Carbon\Carbon;

class DashboardController extends Controller
{
    public function index(){
        $posts = Post::all();
        $popular_posts = Post::withCount('comments')
                            ->withCount('favorite_to_users')
                            ->orderBy('view_count','desc')
                            ->orderBy('comments_count','desc')
                            ->orderBy('favorite_to_users_count','desc')
                            ->take(5)
                            ->get();
        $total_panding_posts = Post::where('is_approved',false)
                                ->count();

        $all_views = Post::sum('view_count');
        $author_count = User::where('role_id',2)->count();

        $new_author_today = User::where('role_id',2)
                                ->whereDate('created_at',Carbon::today())
                                ->count();
        $active_author = User::where('role_id',2)
                            ->withCount('posts')
                            ->withCount('comments')
                            ->withCount('favorite_posts')
                            ->orderBy('posts_count','desc')
                            ->orderBy('comments_count','desc')
                            ->orderBy('favorite_posts_count','desc')
                            ->take(5)
                            ->get();
        $category_all_count = Category::all()->count();
        $teg_all_count = Tag::all()->count();
        // echo "<pre>";
        // print_r($total_panding_posts);
        return view('admin.dashboard',compact('posts','popular_posts','total_panding_posts',
                                            'all_views','author_count','new_author_today',
                                            'active_author','category_all_count','teg_all_count'));
    }
}
