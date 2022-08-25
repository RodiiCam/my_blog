@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                @foreach ($paginatedPosts as $post)
                    <div class="card">
                        <h5 class="card-header">{{ $post->title }}</h5>
                        <div class="card-body">
                            <h5 class="card-title"></h5>
                            <p class="card-text">{{ $post->body }}</p>
                            <a href="{{ route('dashboard.post.edit', $post->id) }}" class="btn btn-primary">Edit</a>
                            {{-- <a href="#" class="btn btn-primary">Delete</a> --}}
                        </div>
                    </div>
                    <br>
                @endforeach

                <div>{{ $paginatedPosts->links() }}</div>
            </div>
        </div>
    </div>
@endsection
