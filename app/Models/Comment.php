<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    use HasFactory;

    protected $fillable = ['content', 'post_id', 'user_id'];

    public function user()
    {
        return $this->belongsTo(User::class); // comment blongs to a single user
    }

    public function post()
    {
        return $this->belongsTo(Post::class); // comment blongs to a single post
    }
}
