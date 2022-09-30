@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <h1 class="">Create Post</h1>
            </div>

            <div class="col-md-8">
                @if (session('create_success'))
                    <div class="alert alert-success">
                        {{ session('create_success') }}
                    </div>
                @endif
                <div class="">
                    <form method="POST" action="{{ route('dashboard.post.create') }}">
                        @csrf
                        <div class="form-group mb-3">
                            <label for="post-title">Post Title</label>
                            <input type="text" class="form-control mb-1" name="post_title" id="post-title" placeholder="Title" value="{{ old('post_title') }}">
                            @error('post_title')
                                <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group mb-3">
                            <label for="post-body">Post Body</label>
                            <textarea class="form-control mb-1" name="post_body" id="post-body" rows="5" placeholder="Body...">{{ old('post_body') }}</textarea>
                            @error('post_body')
                                <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group mb-3">
                            <div><label for="post-status">Post Status</label></div>
                            <select name="post_status" id="post-status" class="mb-1">
                                <option value="">--Please choose an option--</option>
                                <option value="0">Draft</option>
                                <option value="1">Unpublished</option>
                                <option value="2">Published</option>
                            </select>
                            @error('post_status')
                                <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <button type="submit" class="btn btn-primary">Create</button>
                        <a href="{{ route('home') }}" type="button" class="btn btn-primary">Back</a>
                    </form>
                    <br>
                </div>
                <br>
            </div>
        </div>
    </div>
@endsection
