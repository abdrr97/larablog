@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-10">
                <h1>Create Post</h1>
                <section class="card">
                    <div class="card-body">
                        @if ($errors->any())
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif

                        <form enctype="multipart/form-data" action="{{ route('posts.update', $post) }}" method="POST">
                            @csrf
                            @method('PUT')

                            <div class="form-group row">
                                <label for="title" class="col-md-4 col-form-label text-md-right">Title</label>

                                <div class="col-md-6">
                                    <input id="title" type="text" class="form-control @error('title') is-invalid @enderror"
                                        name="title" value="{{ $post->title }}" autofocus>

                                    @error('title')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="content" class="col-md-4 col-form-label text-md-right">Content</label>

                                <div class="col-md-6">
                                    <textarea id="content" rows="10"
                                        class="ckeditor form-control @error('content') is-invalid @enderror"
                                        name="content">{{ $post->content }}</textarea>

                                    @error('content')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>



                            <div class="form-group row">
                                <label for="image" class="col-md-4 col-form-label text-md-right">Image</label>

                                <div class="col-md-6">
                                    <img src="{{ Storage::url($post->image) }}" class="img-fluid my-4 ">
                                    <input type="file" id="image"
                                        class="form-control-file @error('image') is-invalid @enderror" name="image">

                                    @error('image')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>


                            <div class="form-group row">
                                <label for="category_id" class="col-md-4 col-form-label text-md-right">Category</label>
                                <div class="col-md-6">
                                    <select class="form-control  @error('category_id') is-invalid @enderror"
                                        name="category_id">
                                        @foreach ($categories as $c)
                                            <option {{ $post->category->id === $c->id ? 'selected' : '' }}
                                                value="{{ $c->id }}">{{ $c->name }}</option>
                                        @endforeach
                                    </select>

                                    @error('category_id')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="published" class="col-md-4 form-check-label text-md-right">Publish</label>

                                <div class="col-md-6">
                                    <input {{ $post->published ? 'checked' : '' }} type="checkbox" id="published"
                                        class=" @error('published') is-invalid @enderror" name="published">

                                    @error('published')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <button class="btn btn-info m-3"> Save </button>
                        </form>
                    </div>
                </section>
            </div>
        </div>
    </div>
@endsection
