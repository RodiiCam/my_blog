@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="post-buttons d-flex justify-content-end pb-2">
                    <a class="btn btn-primary add-post" href={{ route('dashboard.post.create') }}>Add Post</a>
                </div>
                @foreach ($paginatedPosts as $post)
                    <div class="card">
                        <h5 class="card-header">{{ $post->title }}</h5>
                        <div class="card-body">
                            <h5 class="card-title"></h5>
                            <p class="card-text">{{ $post->body }}</p>
                            @can(['update'], $post)
                            <a href="{{ route('dashboard.post.edit', $post->id) }}" class="btn btn-primary">Edit</a>
                            @endcan
                            @can(['delete'], $post)
                            <button type="button" class="btn btn-primary delete-post" data-post-id="{{ $post->id }}" data-bs-toggle="modal" data-bs-target="#delete-post-confirm-dialog">Delete</button>
                            @endcan
                        </div>
                    </div>
                    <br>
                @endforeach

                <div>{{ $paginatedPosts->links() }}</div>
            </div>
        </div>
    </div>
    <x-delete-post-confirm />
    <x-delete-post-success />
    <x-delete-post-error />
@endsection
