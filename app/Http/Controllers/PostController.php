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
use Illuminate\Notifications\DatabaseNotification;

class PostController extends Controller
{
    //public function index(Post $post)
    //{
      //  return view('posts.index')->with(['posts' => $post->get()]);
    //}
    
     public function index(User $user, Post $post, InformationNotification $notifications)
    {
        $user = User::find(1);
        $posts = $user->paginatedPosts(5);
        //dd($posts);
        // 対象のページ番号取得
        //$page =  $request->get('page', 1);
        // ページネーションで取得
        //$notifications = $user->paginatedInformations(3);
        $user->notifications()->paginate(3);
        //dd($notifications);
        return view('posts.index',compact('user','posts', 'notifications'));
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
    
    public function delete(Post $post, Information $information)
    {
        $information->Information::where('site_name', $post->site_name )->get();
        dd($information);
        $information->delete();
        $post->delete();
        return redirect('/index');
    }
}



