<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PostController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth')->except(['index', 'show']);
    }

    public function index()
    {
        $posts = Post::where('published', true)->latest()->paginate(15);

        return view('posts.index', compact('posts'));
    }
    public function create()
    {
        $categories = Category::all();
        return view('posts.create', compact('categories'));
    }
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|min:6',
            'content' => 'required',
            'image' => 'required|image|mimes:png,jpeg,jpg,svg|max:2048',
            'category_id' => 'required|exists:categories,id'
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
        abort_if($post->user->id !== auth()->id(), 403);

        $categories = Category::all();
        return view('posts.edit', compact('post', 'categories'));
    }
    public function update(Request $request, Post $post)
    {
        abort_if($post->user->id !== auth()->id(), 403);

        $request->validate([
            'title' => 'required|min:6',
            'content' => 'required',
            'image' => 'image|mimes:png,jpeg,jpg,svg|max:2048',
            'category_id' => 'required|exists:categories,id'
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
        abort_if($post->user->id !== auth()->id(), 403);

        Storage::delete($post->image);
        $post->delete();

        return redirect()->route('posts.index');
    }
}
