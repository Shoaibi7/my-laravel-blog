<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CommentController extends Controller
{
    public function store(Request $request, $post_id){
        // dd($post_id);
        $user_id = Auth::user()->id;
        $commentData = new Comment();

        $commentData->user_id = $user_id;
        $commentData->post_id = $post_id;
        $commentData->comment = $request->comment;
        $commentData->save();

        return redirect()->back()->with('success','Comment Save Successfully');

    }
}
