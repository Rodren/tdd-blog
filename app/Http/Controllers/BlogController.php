<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use Illuminate\Http\Request;

class BlogController extends Controller
{
    public function index()
    {
        $blogs = Blog::all();
        return view('blog.index', compact('blogs'));
    }

    public function create()
    {
        return view('blog.create');
    }

    public function show(Blog $blog)
    {
        return view('blog.show', compact('blog'));
    }

    public function store(Request $request)
    {
        Blog::create($request->all());

        return redirect('/blog');
    }

    public function destroy(Blog $blog)
    {
        $blog->delete();

        return redirect('/blog');
    }

    public function edit(Blog $blog)
    {
        return view('blog.edit', compact('blog'));
    }

    public function update(Request $request, Blog $blog)
    {
        $blog->update($request->all());
        return redirect('/blog');
    }
}
