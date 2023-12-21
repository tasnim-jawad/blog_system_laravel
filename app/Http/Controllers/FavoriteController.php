<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Brian2694\Toastr\Facades\Toastr;

class FavoriteController extends Controller
{
    public function add($post){
        $user =Auth::user();
        $isFavorite = $user->favorite_posts()->where('post_id',$post)->count();

        if($isFavorite == 0){
            $user->favorite_posts()->attach($post);
            Toastr::success('Post has been successfully added to favorite list', 'success');
            return redirect()->back();
        }else{
            $user->favorite_posts()->detach($post);
            Toastr::success('Post has been remove from favorite list', 'success');
            return redirect()->back();
        }
    }
}
