@extends('layouts.app')

@section('content')
<style>
    body {
        font-family: 'Roboto', sans-serif;
        background-color: #f5f5f5; /* Changed background color */
    }

    .carousel-inner img {
        max-height: 400px; /* Increased max-height for better visibility */
        object-fit: cover;
    }

    .carousel-caption {
        background: rgba(0, 0, 0, 0.6);
        padding: 15px;
        border-radius: 10px;
    }

    .welcome-section {
        background: linear-gradient(45deg, #ff8c00, #ff6347);
        color: #fff;
        padding: 80px 0; /* Increased padding */
        text-align: center;
        border-radius: 20px; /* Increased border-radius */
        margin-bottom: 50px; /* Increased margin */
    }

    .post-card {
        background: #ffffff;
        border: 1px solid #e1e1e1;
        border-radius: 10px;
        margin-bottom: 30px;
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1); /* Increased box-shadow */
        transition: transform 0.3s, box-shadow 0.3s; /* Added box-shadow transition */
        padding: 20px; /* Increased padding */
    }

    .post-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 6px 20px rgba(0, 0, 0, 0.15); /* Enhanced shadow on hover */
    }

    .post-card h2 {
        color: #333;
        font-size: 28px; /* Increased font size */
        margin-bottom: 10px; /* Added margin */
    }

    .post-card p {
        color: #555;
        line-height: 1.6; /* Improved line-height for better readability */
        margin-bottom: 15px; /* Added margin */
    }

    .post-card img {
        border-radius: 10px;
        width: 100%; /* Ensured image width is 100% */
        height: 350px; /* Added to maintain aspect ratio */
        margin-bottom: 20px; /* Added margin */
    }

    .post-card .card-footer {
        background: #f9f9f9; /* Changed background color */
        border-top: 1px solid #e1e1e1;
        padding: 15px 20px; /* Increased padding */
    }

    .post-card .card-footer span {
        color: #888;
        font-size: 14px;
        margin-right: 10px; /* Added margin */
    }

    .share-buttons a {
        margin-right: 15px; /* Increased margin */
        text-decoration: none;
    }

    .footer {
        background: #232526;
        color: #f8f9fa;
        padding: 60px 0; /* Increased padding */
        border-top: 3px solid #ff8c00; /* Added border-top */
    }

    .footer a {
        color: #17a2b8;
        text-decoration: none;
    }

    .footer a:hover {
        text-decoration: underline;
    }

    .footer .quick-links a {
        margin-right: 20px; /* Increased margin */
        font-size: 16px; /* Increased font size */
    }

    .footer .about p {
        color: #ccc;
        line-height: 1.6; /* Improved line-height for better readability */
    }

    .footer-bottom {
        background: #414345;
        padding: 15px 0; /* Increased padding */
        color: #ccc;
    }
</style>

<div class="container mb-5">
    <div class="row justify-content-center">
        @if (session('status'))
            <div class="alert alert-success" role="alert">
                {{ session('status') }}
            </div>
        @endif

        <div class="col-md-12 welcome-section">
            <h2 class="display-4">Welcome To My News Blog</h2>
            <p class="lead">Stay updated with the latest news and insights.</p>
        </div>

        <div class="col-md-12 mb-5">
            <div id="newsCarousel" class="carousel slide carousel-dark" data-bs-ride="carousel">
                <div class="carousel-inner">
                    @foreach ($posts->take(3) as $index => $post)
                        <div class="carousel-item {{ $index == 0 ? 'active' : '' }}">
                            <img src="{{ asset('storage/images/' . $post->image) }}" class="d-block w-100" alt="{{ $post->title }}">
                            <div class="carousel-caption d-none d-md-block">
                                <h5 class="text-white">{{ $post->title }}</h5>
                                <p class="text-white">{{ Str::limit($post->content, 100) }}</p>
                            </div>
                        </div>
                    @endforeach
                </div>
                <button class="carousel-control-prev" type="button" data-bs-target="#newsCarousel" data-bs-slide="prev">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Previous</span>
                </button>
                <button class="carousel-control-next" type="button" data-bs-target="#newsCarousel" data-bs-slide="next">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Next</span>
                </button>
            </div>
        </div>

        <div class="col-md-10">
            @foreach ($posts as $post)
                <div class="post-card">
                    <h2>{{ $post->title }}</h2>
                    <p>{{ Str::limit($post->content, 150) }}</p>
                    @if ($post->image)
                        <img src="{{ asset('storage/images/' . $post->image) }}" class="img-fluid" alt="{{ $post->title }}">
                    @endif
                    <div class="card-footer d-flex justify-content-between align-items-center mt-3">
                        <span>Posted On {{ $post->created_at->format('M d, Y') }}</span>
                        <div>
                            <button class="btn btn-link like-btn" data-postid="{{ $post->id }}">
                                <i class="fas fa-thumbs-up"></i> Like
                            </button>
                            <span class="likes-count">{{ $post->likes()->count() }}</span> Likes
                        </div>
                    </div>
                    <div class="share-buttons mt-3 d-flex justify-content-center">
                        <a href="https://www.facebook.com/sharer/sharer.php?u={{ urlencode(Request::url()) }}" target="_blank" class="btn btn-primary btn-sm">
                            <i class="fab fa-facebook-f"></i> Share on Facebook
                        </a>
                        <a href="https://twitter.com/intent/tweet?url={{ urlencode(Request::url()) }}&text={{ urlencode($post->title) }}" target="_blank" class="btn btn-info btn-sm">
                            <i class="fab fa-twitter"></i> Share on X
                        </a>
                        <a href="https://www.linkedin.com/sharing/share-offsite/?url={{ urlencode(Request::url()) }}" target="_blank" class="btn btn-secondary btn-sm">
                            <i class="fab fa-linkedin-in"></i> Share on LinkedIn
                        </a>
                    </div>

                    <div class="comments-section mt-4">
                        <h5>Comments</h5>
                        @foreach ($post->comments as $comment)
                            <div class="comment p-3 mb-2 bg-light rounded">
                                <p>{{ $comment->comment }}</p>
                                <small class="text-muted">Posted by: {{ $comment->user->name }}</small>
                            </div>
                        @endforeach
                        <!-- Comment form -->
                        <form action="{{ route('comment.store', $post->id) }}" method="POST" class="mt-3">
                            @csrf
                            <div class="mb-3">
                                <textarea class="form-control" name="comment" id="comment" rows="4" placeholder="Enter Comment..." required></textarea>
                            </div>
                            <button type="submit" class="btn btn-sm btn-info">Save</button>
                        </form>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</div>

<footer class="footer mt-5">
    <div class="container">
        <div class="row">
            <div class="col-lg-4 col-md-6 about">
                <h4>About Us</h4>
                <p>Your blog description or a brief about your blog can go here. Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>
            </div>
            <div class="col-lg-4 col-md-6">
                <h4>Quick Links</h4>
                <ul class="list-unstyled quick-links">
                    <li><a href="#">Home</a></li>
                    <li><a href="/">Blog</a></li>
                    <li><a href="#">About</a></li>
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
        <p>&copy; {{ date('Y') }} My News Blog. All rights reserved.</p>
    </div>
</footer>
@endsection

@section('scripts')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script>
    $(document).ready(function() {
        $('.share-buttons a').on('click', function(e) {
            e.preventDefault();
            var width = 575,
                height = 400,
                left = ($(window).width() - width) / 2,
                top = ($(window).height() - height) / 2,
                url = this.href,
                opts = 'status=1,width=' + width + ',height=' + height + ',top=' + top + ',left=' + left;
            window.open(url, 'share', opts);
            return false;
        });

        var $likeBtn = $('.like-btn');

        $likeBtn.click(function(e) {
            e.preventDefault();
            var $clickedBtn = $(this);
            var postId = $clickedBtn.data('postid');
            
            if ({{ Auth::check() ? 'true' : 'false' }}) {
                $.ajax({
                    type: 'POST',
                    url: '{{ url('like-store') }}/' + postId,
                    data: {
                        "_token": "{{ csrf_token() }}"
                    },
                    success: function(response) {
                        var $likesCount = $clickedBtn.siblings('.likes-count');
                        $likesCount.html(response.likes);
                        window.location.reload();
                    },
                    error: function(xhr, status, error) {
                        console.error(xhr.responseText);
                    }
                });
            } else {
                alert('Please login first to like.');
                window.location.href = '{{ route('login') }}';
            }
        });
    });
</script>
@endsection
