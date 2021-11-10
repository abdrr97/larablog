<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class UserController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth')->only(['posts']);
    }

    public function posts()
    {
        $posts = auth()->user()->posts()->latest()->paginate(15);

        return view('users.posts', compact('posts'));
    }

    // GET
    public function profile()
    {
        $user = auth()->user();
        return view('users.profile', compact('user'));
    }

    // PUT
    public function update(Request $request)
    {

        $user = auth()->user();
        $avatar_path = $user->avatar;
        if ($request->hasFile('avatar'))
        {
            if (!str_contains($user->avatar, 'default'))
            {
                Storage::delete($user->avatar);
            }
            $avatar_path = $request->file('avatar')->store('users');
        }


        $user->update([
            'name' => $request->name,
            'avatar' => $avatar_path
        ]);

        return redirect()->back();
    }
}
