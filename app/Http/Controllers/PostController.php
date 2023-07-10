<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use Illuminate\Support\Facades\Auth;

class PostController extends Controller
{
    //public function index(Post $post)
    //{
      //  return view('posts.index')->with(['posts' => $post->get()]);
    //}
    
     public function index()
    {
        $user = Auth::user();
        $post = $user->posts;
        return view('posts.index',compact('user','post'));
    }
    
    public function edit()
    {
        $user = Auth::user();
        $post = $user->posts;
        return view('posts.edit',compact('user','post'));
    }
}
