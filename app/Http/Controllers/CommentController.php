<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Comment;
use Illuminate\Support\Facades\Auth;
use Brian2694\Toastr\Facades\Toastr;

class CommentController extends Controller
{
    public function store(Request $request, $post){
        $validated = $request->validate([
            'comment' => 'required',
        ]);

        $comment = new Comment();
        $comment->post_id =$post;
        $comment->user_id = Auth::id();
        $comment->comment= $request->comment;
        $comment->save();

        Toastr::success('Comment succesfully added', 'success');
        return redirect()->back();

    }
}
