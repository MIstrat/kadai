<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\Site;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Http\FormRequest;
use App\Http\Requests\PostRequest;

class PostController extends Controller
{
    //public function index(Post $post)
    //{
      //  return view('posts.index')->with(['posts' => $post->get()]);
    //}
    
     public function index(Post $post)
    {
        $user = Auth::user();
        $posts = $user->paginatedPosts(10);;
        //dd($posts);
        return view('posts.index',compact('user','posts'));
        //return view('posts.index')->with(['posts' => $post]);
        //return view('posts.index')->with(['user' => $user]);
    }
    
    public function info(Post $post)
    {
        //$user = Auth::user();
        //$posts = $user->paginatedPosts();
        return view('posts.info')->with(['post' => $post]);
    }
    
    public function edit(Post $post)
    {
        //$user = Auth::user();
        //$post = posts->get();
        return view('posts.edit')->with(['post' => $post]);
    }
    
    public function update(PostRequest $request, Post $post)
    {
        $input_post = $request['post'];
        $input['user_id'] = Auth::user()->id;
        //dd($input);
        $post->fill($input_post)->save();
        
        
        return redirect('/index/'. $post->id);
    }

    public function store(PostRequest $request, Post $post)
    {
        $input = $request['post'];
        //$site -> get('id');
        $input['user_id'] = Auth::user()->id;
        //$input['site_id'] = $site->id;
        //dd($input);
        $post->fill($input)->save();
        
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



