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
            <h2>Welcome To My News Blog</h2>
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
                <button class="btn btn-link like-btn" data-postid="{{ $post->id }}">
                    <i class="fas fa-thumbs-up"></i> Like
                </button>
                
                <span class="likes-count">{{ $post->likes()->count() }}</span> Likes
            </div>
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
                    <button class="btn btn-link like-btn" data-postid="{{ $post->id }}">
                        <i class="fas fa-thumbs-up"></i> Like
                    </button>
                    <span class="likes-count">{{ $post->likes()->count() }}</span> Likes
                    <div class="share-buttons mt-2">
                        <a href="https://www.facebook.com/sharer/sharer.php?u={{ urlencode(Request::url()) }}" target="_blank" class="btn btn-primary btn-sm">
                            <i class="fab fa-facebook-f"></i> Share on Facebook
                        </a>
                        <a href="https://twitter.com/intent/tweet?url={{ urlencode(Request::url()) }}&text={{ urlencode($post->title) }}" target="_blank" class="btn btn-info btn-sm">
                            <i class="fab fa-twitter"></i> Share on X
                        </a>
                        <a href="https://www.linkedin.com/sharing/share-offsite/?url={{ urlencode(Request::url()) }}" target="_blank" class="btn btn-secondary btn-sm">
                            <i class="fab fa-linkedin-in"></i> Share on linkedin
                        </a>
                    </div>
                </div>
            
                <div class="comments-section mt-3">
                    <h5>Comments</h5>
                    @foreach ($post->comments as $comment)
                        <div class="comment">
                            <p>{{ $comment->comment }}</p>
                            <small>Posted by: {{ $comment->user->name }}</small>
                        </div>
                    @endforeach
                    <!-- Comment form -->
                    <form action="{{ route('comment.store', $post->id) }}" method="POST" enctype="multipart/form-data" class="mt-3">
                        @csrf
                        <div class="mb-3">
                            <textarea type="text" rows="4" cols="2" class="form-control" name="comment" id="comment" placeholder="Enter Comment..." title="Please enter a comment" required></textarea>
                            <div class="invalid-feedback">Please enter a comment</div>
                        </div>
                        <button type="submit" class="btn btn-sm btn-info">Save</button>
                    </form>
                </div>
            </div>
            

            <div class="comments-section mt-3">
                <h5>Comments</h5>
                @foreach ($post->comments as $comment)
                    <div class="comment">
                        <p>{{ $comment->comment }}</p>
                        <small>Posted by: {{ $comment->user->name }}</small>
                    </div>
                @endforeach
                <!-- Comment form -->
                <form action="{{ route('comment.store', $post->id) }}" method="POST" enctype="multipart/form-data" class="mt-3">
                    @csrf
                    <div class="mb-3">
                        <textarea type="text" rows="4" cols="2" class="form-control" name="comment" id="comment" placeholder="Enter Comment..." title="Please enter a comment" required></textarea>
                        <div class="invalid-feedback">Please enter a comment</div>
                    </div>
                    <button type="submit" class="btn btn-sm btn-info">Save</button>
                </form>
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
                opts = 'status=1' +
                       ',width=' + width +
                       ',height=' + height +
                       ',top=' + top +
                       ',left=' + left;
            window.open(url, 'share', opts);
            return false;
        });


    // Cache the jQuery object for the like button
    var $likeBtn = $('.like-btn');

    $likeBtn.click(function(e) {
        e.preventDefault();

        // Cache the jQuery object for the clicked like button
        var $clickedBtn = $(this);
        var postId = $clickedBtn.data('postid');
        
        // Check if the user is authenticated
        if ({{ Auth::check() ? 'true' : 'false' }}) {
            // User is authenticated, proceed with the like action
            $.ajax({
                type: 'POST',
                url: '{{ url('like-store') }}/' + postId,
                data: {
                    "_token": "{{ csrf_token() }}"
                },
                success: function(response) {
                    // Update likes count on success
                    var $likesCount = $clickedBtn.siblings('.likes-count');
                    $likesCount.html(response.likes);
                    window.location.reload();
                },
                error: function(xhr, status, error) {
                    console.error(xhr.responseText);
                }
            });
        } else {
            // User is not authenticated, prompt to log in
            alert('Please login first to like.');
            // You can redirect the user to the login page if needed
            window.location.href = '{{ route('login') }}';
        }
    });
});


</script>
