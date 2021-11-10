@extends('layouts.app')

@section('content')
    <main class="container">
        <section class="row justify-content-center">
            <section class="col-md-8">
                <h1>Posts</h1>


                @forelse ($posts as $post)
                    <article class="card mb-3">
                        <div class="card-body">
                            <h4><a href="{{ route('posts.show', $post) }}">{{ $post->title }}</a></h4>

                            <p>
                                {{ $post->content }}
                            </p>

                            <div>Comments: {{ $post->comments->count() }}</div>
                        </div>
                        <div class="card-footer d-flex justify-content-between align-items-center">
                            <div>
                                <img style="border-radius:50%;width:30px" src="{{ Storage::url($post->user->avatar) }}"
                                    alt="">
                                <b>{{ ucfirst($post->user->username) }}</b>
                            </div>
                            <div>
                                <div class="btn-group">
                                    <a class="btn btn-sm btn-warning" href="{{ route('posts.edit', $post) }}">
                                        Edit Post
                                    </a>
                                    <form action="{{ route('posts.destroy', $post) }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button class="btn btn-sm btn-danger">Delete Post</button>
                                    </form>
                                </div>
                                {{ $post->created_at->diffForHumans() }}
                            </div>
                        </div>
                    </article>
                @empty
                    <h1 class="display-3">No Posts</h1>
                @endforelse
                {{ $posts->links() }}
            </section>
        </section>
    </main>
@endsection
