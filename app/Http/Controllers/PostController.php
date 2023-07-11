<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\Site;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Http\FormRequest;

class PostController extends Controller
{
    //public function index(Post $post)
    //{
      //  return view('posts.index')->with(['posts' => $post->get()]);
    //}
    
     public function index()
    {
        $user = Auth::user();
        $posts = $user->paginatedPosts(2);;
        //dd($posts);
        return view('posts.index',compact('user','posts'));
        //return view('posts.index')->with(['posts' => $post]);
        //return view('posts.index')->with(['user' => $user]);
    }
    
    public function edit()
    {
        $user = Auth::user();
        $post = $user->posts;
        return view('posts.edit',compact('user','post'));
    }
    
    public function store(Request $request, Post $posts, Site $site)
    {
        $input = $request['posts'];
        $site -> get('id');
        $input['user_id'] = Auth::user()->id;
        //$input['site_id'] = $site->id;
        $posts->fill($input)->save();
        return redirect('/index' );
    }
    
        public function siteedit()
    {
        $input = $request['posts'];
        $input['user_id'] = Auth::user()->id;
        $input['site_id'] = site()->id;
        $posts->fill($input)->save();
        return redirect('/index/edit/siteedit' );
    }
}



