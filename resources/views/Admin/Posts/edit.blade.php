@extends('layouts.app')

@section('content')
<div class="container mb-4">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Edit Post') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    <form action="{{ route('post.update', $post->id) }}" method="POST" enctype="multipart/form-data" id="postForm">
                        @csrf
                        @method('PUT') <!-- Use PUT method for update -->
                        <div class="mb-3">
                            <label for="title" class="form-label">Title</label>
                            <input type="text" class="form-control" name="title" id="title" placeholder="Enter Post Title..." pattern=".{1,255}" title="Please enter a title (1-255 characters)" value="{{ $post->title }}" required>
                            <div class="invalid-feedback">Please enter a title (1-255 characters).</div>
                        </div>
                        <div class="mb-3">
                            <label for="content" class="form-label">Content</label>
                            <textarea class="form-control" name="content" id="content" placeholder="Enter Post Content..." required>{{ $post->content }}</textarea>
                            <div class="invalid-feedback">Please enter content.</div>
                        </div>
                        <div class="mb-3">
                            <label for="image" class="form-label">Image</label>
                            <input type="file" class="form-control" name="image" id="image" accept="image/*">
                            @if ($post->image)
                                <img src="{{ asset('storage/images/' . $post->image) }}" alt="{{ $post->title }}" class="img-fluid mt-2">
                            @endif
                            <div class="invalid-feedback">Please select an image.</div>
                        </div>
                        <div class="mb-3">
                            <label for="status" class="form-label">Status</label>
                            <select class="form-select" name="status" id="status" required>
                                <option value="">Select Status</option>
                                <option value="1" @if($post->publish == '1') selected @endif>Publish</option>
                                <option value="0" @if($post->publish == '0') selected @endif>Draft</option>
                            </select>
                            <div class="invalid-feedback">Please select a status.</div>
                        </div>
                        <div class="mb-3">
                            <button type="submit" class="btn btn-primary btn-sm">Update</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
