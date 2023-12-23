<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Brian2694\Toastr\Facades\Toastr;

class AuthorController extends Controller
{
    public function index(){
        $authors = User::authors()
                ->withCount('posts')
                ->withCount('comments')
                ->withCount('favorite_posts')
                ->get();

        return view('admin.authors',compact('authors'));
    }

    public function destroy($id){
        $author = User::findOrFail($id);
        $author->delete();
        Toastr::success('author has been deleted successfuly', 'success');
        return redirect()->back();
    }
}
