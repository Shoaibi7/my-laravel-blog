@extends('layouts.app')

@section('content')
<div class="container mb-4">
    <div class="row justify-content-center">
        @if (session('status'))
        <div class="alert alert-success" role="alert">
            {{ session('status') }}
        </div>
    @endif
    <div class="col-md-10">
      
            <div class="post-card mb-4 p-3 bg-light rounded">
                <div class="card-header">
                    <h2 class="text-primary">{{ $post->title }}</h2>
                </div>
                <div class="card-body mb-2">
                    <p class="text-secondary">{{ $post->content }}</p>
                    @if ($post->image)
                        <img src="{{ asset('storage/images/' . $post->image) }}" width="400px" class="img-fluid rounded" alt="{{ $post->title }}">
                    @endif
                </div>
                <div class="card-footer text-muted">
                    <span>Posted On {{ $post->created_at->format('M d, Y') }}</span>
                </div>
            </div>
   
    </div>
    
    </div>
</div>


@endsection
