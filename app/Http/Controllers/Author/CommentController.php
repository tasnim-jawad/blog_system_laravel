<?php

namespace App\Http\Controllers\Author;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Brian2694\Toastr\Facades\Toastr;
use App\Models\Comment;

class CommentController extends Controller
{
    public function index(){
        $posts = Auth::user()->posts;
        return view('author.comments',compact('posts'));
    }

    public function destroy($id){
        $comment = Comment::findOrFail($id);
        if($comment->post->user->id == Auth::id()){
            $comment->delete();
            Toastr::success('Comment has been deleted successfuly', 'success');
        }else{
            Toastr::warning('You are not authorized to delete this comment', 'warning');
        }

        return redirect()->back();
    }
}
