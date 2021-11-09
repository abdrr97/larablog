<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PostController extends Controller
{
    public function index()
    {
        $posts = Post::where('published', true)->latest()->paginate(15);

        return view('posts.index', compact('posts'));
    }
    public function create()
    {
        return view('posts.create');
    }
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|min:6',
            'content' => 'required',
            'image' => 'required|image|mimes:png,jpeg,jpg,svg|max:2048',
            'category_id' => 'required|exists:categories'
        ]);
        // upload image
        $path = $request->file('image')->store('posts');

        Post::create([
            'title' => $request->title,
            'content' => $request->content,
            'image' => $path,
            'published' => $request->has('published'),
            'user_id' => auth()->id(),
            'category_id' => $request->category_id,
        ]);

        return redirect()->route('posts.index');
    }
    public function show(Post $post) // route model binding
    {
        return view('posts.show', compact('post'));
    }
    public function edit(Post $post)
    {
        return view('posts.edit', compact('post'));
    }
    public function update(Request $request, Post $post)
    {
        $request->validate([
            'title' => 'required|min:6',
            'content' => 'required',
            'image' => 'image|mimes:png,jpeg,jpg,svg|max:2048',
            'category_id' => 'required|exists:categories'
        ]);

        $path = $post->image; // /posts/1.png
        if ($request->hasFile('image')) // true
        {
            $path = $request->file('image')->store('posts'); // /posts/2.png
            Storage::delete($post->image);
        }

        $post->update([
            'title' => $request->title,
            'content' => $request->content,
            'image' => $path,
            'published' => $request->has('published'),
            'category_id' => $request->category_id,
        ]);

        return redirect()->route('posts.index');
    }

    public function destroy(Post $post)
    {
        $post->delete();

        return redirect()->route('posts.index');
    }
}