<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;

    protected $fillable = ['title', 'content', 'image', 'published', 'user_id', 'category_id'];

    public function user()
    {
        return $this->belongsTo(User::class); // post belongs to a single user
    }

    public function category()
    {
        return $this->belongsTo(Category::class); // post belongs to a single category
    }

    public function comments()
    {
        return $this->hasMany(Comment::class); // post has many comments
    }
}
