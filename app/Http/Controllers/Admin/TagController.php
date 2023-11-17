<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Tag;
use Illuminate\Support\Str;
use Brian2694\Toastr\Facades\Toastr;


class TagController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $tag = Tag::latest()->get();
        return view('admin.tag.index',compact('tag'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.tag.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required',
        ]);
        $tag = new Tag();
        $tag->name =$request->name;
        $tag->slug = Str::slug($request->name);
        $tag->save();
        Toastr::success('Tag successfully saved', 'success');

        return redirect()->Route('admin.tag.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {

    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $tag = Tag::find($id);
        return view('admin.tag.edit',compact('tag'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $validated = $request->validate([
            'name' => 'required',
        ]);
        $tag = Tag::find($id);
        $tag->name =$request->name;
        $tag->slug = Str::slug($request->name);
        $tag->save();
        Toastr::success('Tag successfully saved', 'success');

        return redirect()->Route('admin.tag.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        Tag::find($id)->delete();
        Toastr::success('Tag successfully deleted', 'success');
        return redirect()->Route('admin.tag.index');
    }
}
