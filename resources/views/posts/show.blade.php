@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <h1 class="display-4"> {{ $post->title }}</h1>

                <img src="{{ Storage::url($post->image) }}" class="img-fluid">

                <p>
                    {{ $post->content }}
                </p>

                <h4>Comments</h4>
                @forelse ($post->comments as $comment)
                    <div class="card mb-2">
                        <div class="card-body">
                            <div class="mb-3">
                                <img style="border-radius:50%;width:30px" src="{{ Storage::url($post->user->avatar) }}"
                                    alt="">
                                <b>{{ ucfirst($comment->user->username) }}</b>
                            </div>
                            {{ $comment->content }}
                        </div>
                    </div>
                @empty
                    <h3>no comments</h3>
                @endforelse
            </div>
        </div>
    </div>
@endsection
