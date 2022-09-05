@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="">Edit Post</div>
            </div>

            <div class="col-md-8">
                @if (session('update_success'))
                    <div class="alert alert-success">
                        {{ session('update_success') }}
                    </div>
                @endif
                <div class="">
                    <form method="POST" action="{{ route('dashboard.post.edit', ['post_id' => $post->id]) }}">
                        @csrf
                        <div class="form-group">
                            <label for="post-title">Post Title</label>
                            @error('post_title')
                                <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                            <input type="text" class="form-control" name="post_title" id="post-title" placeholder="Title"
                                value="{{ old('post_title', $post->title) }}">
                        </div>
                        <div class="form-group">
                            <label for="post-body">Post Body</label>
                            @error('post_body')
                                <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                            <textarea class="form-control" name="post_body" id="post-body" rows="5" placeholder="Body...">{{ old('post_body', $post->body) }}</textarea>
                        </div>
                        <button type="submit" class="btn btn-primary">Save</button>
                        <a href="{{ route('home') }}" type="button" class="btn btn-primary">Back</a>
                    </form>
                    <br>
                </div>
                <br>
            </div>
        </div>
    </div>
@endsection
