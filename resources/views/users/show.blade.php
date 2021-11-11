@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ $user->name }}</div>

                    <div class="card-body">
                        <img width="200" class="mb-5 rounded mx-auto d-block" src="{{ Storage::url($user->avatar) }}"
                            alt="">

                        user :{{ $user->username }}

                        <h6>Posts</h6>
                        <ul>
                            @forelse ($user->posts as $post)
                                <li><a href="{{ route('posts.show', $post) }}">{{ $post->title }}</a>


                                    <span class="badge @if ($post->published) badge-success @else badge-warning @endif">
                                        @if ($post->published) published @else draft @endif
                                    </span>
                                </li>
                            @empty
                                <li>user has no posts</li>
                            @endforelse
                        </ul>

                        <h6>Comments</h6>
                        <ul>
                            @forelse ($user->comments as $c)
                                <li>{{ $c->content }} {{ $c->created_at->diffForHumans() }}</li>
                            @empty
                                <li>user has no comments</li>
                            @endforelse
                        </ul>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
