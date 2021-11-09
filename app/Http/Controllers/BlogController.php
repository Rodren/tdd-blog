<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use Illuminate\Http\Request;

class BlogController extends Controller
{
    public function index() {
        $blogs = Blog::all();
        return view('blog.index', compact('blogs'));
    }

    public function show($id) {
        $blog = Blog::find($id);
        return view('blog.show', compact('blog'));
    }

    public function store(Request $request) {
        Blog::create($request->all());
        
        return redirect('/blog');
    }
}
