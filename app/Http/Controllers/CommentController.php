<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function store(Request $request, Post $post)
    {
        $request->validate([
            'content' => ['required', 'string', 'min:6', 'max:255'],
        ]);

        $post->comments()->create([
            'content' => $request->content,
            'user_id' => auth()->id()
        ]);

        return redirect()->back();
    }
}
