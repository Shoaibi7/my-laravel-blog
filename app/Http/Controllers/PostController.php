<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PostController extends Controller
{
    public function index()
    {
        $posts = Post::where('publish',1)->latest()->get();

        return view('User.my_blog', compact('posts'));
    }

    public function postList()
    {
        $posts = Post::latest()->get();
        return view('Admin.Posts.index', compact('posts'));
    }
    public function create()
    {

        return view('Admin.Posts.create');
    }

    public function store(Request $request)
    {
        try {
            // Validate the request data
            $request->validate([
                'title' => 'required|string|max:255',
                'content' => 'required|string',
                'image' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
            ]);

            // Handle image upload
            if ($request->hasFile('image')) {
                $image = $request->file('image');
                $imageName = time() . '.' . $image->getClientOriginalExtension();
                $image->storeAs('public/images', $imageName);
            } else {
                $imageName = null;
            }

            // Create and store the post
            $post = new Post();
            $post->title = $request->input('title');
            $post->content = $request->input('content');
            $post->image = $imageName; 
            $post->publish = $request->input('status');
            $post->save();
            toastr()->success('Post Created Successfully.');
            return redirect()->route('posts.list');
        } catch (\Exception $e) {
            // Handle exceptions
            return redirect()->back()->withInput()->withErrors(['error' => $e->getMessage()]);
        }
    }
    // Edit a post
    public function edit($post_id)
    {
        try {
            // Find the post by ID
            $post = Post::findOrFail($post_id);

            // Check if the user is authorized to edit the post
            if (auth()->user()->is_admin !== 1) {
                
                toastr()->error('Unauthorized to edit this post');
                return redirect()->back();
            }

            // Return the view to edit the post
            return view('Admin.Posts.edit', compact('post'));
        } catch (\Exception $e) {
            // Handle exceptions
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }


    public function show($id)
    {
        try {
            // Find the post by ID
            $post = Post::findOrFail($id);

            // Return the view to show the post
            return view('Admin.Posts.show', compact('post'));
        } catch (\Exception $e) {
            // Handle exceptions
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }
    public function update(Request $request, $id)
    {
        try {
            // Validate the request data
            $request->validate([
                'title' => 'required|string|max:255',
                'content' => 'required|string',
                'image' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
            ]);

            // Find the post by ID
            $post = Post::findOrFail($id);

            // Handle image upload
            if ($request->hasFile('image')) {
                $image = $request->file('image');
                $imageName = time() . '.' . $image->getClientOriginalExtension();
                $image->storeAs('public/images', $imageName);
                // Delete old image if exists
                if ($post->image) {
                    Storage::delete('public/images/' . $post->image);
                }
                $post->image = $imageName;
            }

            // Update post data
            $post->title = $request->input('title');
            $post->content = $request->input('content');
            $post->publish = $request->input('status');
            $post->save();

            toastr()->success('Post Updated Successfully.');
            return redirect()->route('posts.list');

        } catch (\Exception $e) {
            // Handle exceptions
            return redirect()->back()->withInput()->withErrors(['error' => $e->getMessage()]);
        }
    }
    public function destroy($post_id)
    {
        try {
            // Find the post by ID and delete it
            $post = Post::findOrFail($post_id);
            $post->delete();

            // Redirect back with success message
            toastr()->success('Post deleted Successfully');
            return redirect()->route('posts.list');

        } catch (\Exception $e) {
            // Handle exceptions
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }
}
