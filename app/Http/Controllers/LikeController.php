<?php

namespace App\Http\Controllers;

use App\Models\Like;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class LikeController extends Controller
{
    public function store($post_id){
        $user_id = Auth::user()->id;
    
        // Create or update like
        $like = Like::updateOrCreate(
            ['user_id' => $user_id, 'post_id' => $post_id]
        );
    
        return redirect()->back()->with('success','Like Added Successfully');
    }
}
