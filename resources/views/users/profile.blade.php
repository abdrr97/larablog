@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="card">
            <div class="card-header">My Profile</div>

            <div class="card-body">
                <form enctype="multipart/form-data" method="POST" action="{{ route('user.update') }}">
                    @csrf
                    @method('PUT')

                    <img width="200" class="mb-5 rounded mx-auto d-block" src="{{ Storage::url($user->avatar) }}" alt="">

                    <div class="form-group row">
                        <label for="name" class="col-md-4 col-form-label text-md-right">Name</label>

                        <div class="col-md-6">
                            <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name"
                                value="{{ $user->name }}" autofocus>

                            @error('name')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="avatar" class="col-md-4 col-form-label text-md-right">Avatar</label>

                        <div class="col-md-6">
                            <input id="avatar" type="file" class="@error('avatar') is-invalid @enderror" name="avatar">

                            @error('avatar')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>

                    <div class=" text-center">
                        <button class="btn btn-success my-4"> Save </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
