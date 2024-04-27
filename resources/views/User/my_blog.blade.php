@extends('layouts.app')

@section('content')
<div class="container mb-4">
    <div class="row justify-content-center">
        @if (session('status'))
        <div class="alert alert-success" role="alert">
            {{ session('status') }}
        </div>
    @endif
    <div class="row">
       
        <div class="col text-center">
            <h2>Welcome To My Blog</h2>
            <h6>Lorem ipsum dolor sit amet consectetur adipisicing elit. Expedita optio tempora id consequuntur quia. Itaque praesentium quidem aperiam eius tempora laudantium error cupiditate ex autem, nemo quaerat repellendus veniam voluptatum?</h6>
        </div>
    </div>
    <div class="col-md-10">
        @foreach ($posts as $post)
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
        @endforeach
    </div>
    
    </div>
</div>

<footer class="footer">
    <div class="container">
        <div class="row">
            <div class="col-lg-4 col-md-6">
                <h4>About Us</h4>
                <p>Your blog description or a brief about your blog can go here. Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>
            </div>
            <div class="col-lg-4 col-md-6">
                <h4>Quick Links</h4>
                <ul class="list-unstyled">
                    <li><a href="#">Home</a></li>
                    <li><a href="/">Blog</a></li>
                    <li><a href="#">About</a></li>
                    {{-- <li><a href="#">Contact</a></li> --}}
                </ul>
            </div>
            <div class="col-lg-4 col-md-12">
                <h4>Contact Us</h4>
                <p>Email: myblog@gmail.com</p>
                <p>Phone: +1234567890</p>
            </div>
        </div>
    </div>
</footer>

<footer class="footer-bottom text-center">
    <div class="container">
        <p>&copy; <?php echo date("Y"); ?> My Blog. All rights reserved.</p>
    </div>
</footer>

@endsection
