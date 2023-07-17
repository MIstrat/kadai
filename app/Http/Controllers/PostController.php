<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\User;
use App\Models\Information;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Http\FormRequest;
use App\Http\Requests\PostRequest;
use App\Notifications\InformationNotification;

class PostController extends Controller
{
    //public function index(Post $post)
    //{
      //  return view('posts.index')->with(['posts' => $post->get()]);
    //}
    
     public function index(Post $post)
    {
        $user = Auth::user();
        $posts = $user->paginatedPosts(5);;
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
    
     public function add(Post $post)
    {
        //$user = Auth::user();
        //$post = posts->get();
        return view('posts.store')->with(['post' => $post]);
    }
    
    public function store(PostRequest $request, Post $post, Information $information)
    {
        $input_post = $request['post'];
        $input_post['user_id'] = Auth::user()->id;
        $input_information = $request['post'];
        $input_information['user_id'] = Auth::user()->id;
        //dd($input);
        $post->fill($input_post)->save();
        $information->fill($input_information)->save();

        return redirect('/index' );
    }
    
    
    public function edit(Post $post)
    {
        return view('posts.edit')->with(['post' => $post]);
    }
    
    public function update(PostRequest $request, Post $post, Information $information)
    {
        $input_post = $request['post'];
        $input_post['user_id'] = Auth::user()->id;
        //dd($input);
        $input_information = $request['post'];
        $input_information['user_id'] = Auth::user()->id;
        //dd($input_information);
        $post->fill($input_post)->save();
        $information->fill($input_information)->save();
        
        //dd($information);
        // お知らせ内容を対象ユーザー宛てに通知登録
        $user = Auth::user();
        //dd($user);
        $user->notify(
            new InformationNotification($information)
        );
        
        return redirect('/index/'. $post->id);
        
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



