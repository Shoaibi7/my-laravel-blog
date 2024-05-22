<?php
use App\Http\Controllers\CommentController;
use App\Http\Controllers\LikeController;
use App\Http\Controllers\PostController;
use Illuminate\Support\Facades\Route;

// Define routes for posts, comments, and likes
Route::get('/', [PostController::class, 'index']);
Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::middleware(['auth'])->group(function () {
    // User dashboard route
    Route::get('/user/dashboard', function () {
        return view('User.user_dashboard');
    })->name('user.dashboard');

    // Admin dashboard route
    Route::middleware(['auth'])->group(function () {
        Route::get('/admin/dashboard', function () {
            return view('Admin.admin_dashboard');
        })->name('admin.dashboard');
    });

    // Post routes
    Route::get('/posts', [PostController::class, 'index'])->name('posts.index');
    Route::get('/post/create', [PostController::class, 'create'])->name('post.create');
    Route::post('/post/store', [PostController::class, 'store'])->name('post.store');
    Route::get('/posts/{post_id}/edit', [PostController::class, 'edit'])->name('post.edit');
    Route::put('/posts/{post_id}/update', [PostController::class, 'update'])->name('post.update');
    Route::get('/posts/{post_id}/show', [PostController::class, 'show'])->name('post.show');
    Route::delete('/posts/{post_id}/delete', [PostController::class, 'destroy'])->name('posts.destroy');

    // Comment and Like routes
    Route::post('/comment-store/{post_id}', [CommentController::class, 'store'])->name('comment.store');
    Route::post('/like-store/{post_id}', [LikeController::class, 'store'])->name('like.store');
});
