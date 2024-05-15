<?php

use App\Http\Controllers\CommentController;
use App\Http\Controllers\LikeController;
use App\Http\Controllers\PostController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

// Route::get('/', function () {
//     return view('User.my_blog');
// });
Route::get('/',[PostController::class,'index']);
Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::middleware(['auth'])->group(function () {
    Route::get('/user/dashboard', function () {
        return view('User.user_dashboard');
    })->name('user.dashboard');

    Route::middleware(['auth'])->group(function () {
        Route::get('/admin/dashboard', function () {
            return view('Admin.admin_dashboard');
        })->name('admin.dashboard');
    });

    Route::get('/posts',[PostController::class,'index'])->name('posts.index');
    Route::get('/posts',[PostController::class,'postList'])->name('posts.list');
    Route::get('/post/create',[PostController::class,'create'])->name('post.create');
    Route::post('/post/store',[PostController::class,'store'])->name('post.store');
    Route::get('/posts/{post_id}/edit',[PostController::class,'edit'])->name('post.edit');
    Route::put('/posts/{post_id}/update',[PostController::class,'update'])->name('post.update');
    Route::get('/posts/{post_id}/show',[PostController::class,'show'])->name('post.show');
    Route::delete('/posts/{post_id}/delete',[PostController::class,'destroy'])->name('posts.destroy');

    Route::post('/comment-store/{post_id}',[CommentController::class,'store'])->name('comment.store');
    Route::post('/like-store/{post_id}',[LikeController::class,'store'])->name('like.store');



});

