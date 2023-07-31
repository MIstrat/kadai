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
    
     public function index(User $user, Post $post, Request $request)
    {
        $user = Auth::user();
        $posts = $user->paginatedPosts(5);
        $search = $request->input('search');
        $query = Post::query();
        
        if($search){
            $spaceConversion = mb_convert_kana($search, 's');
             $wordArraySearched = preg_split('/[\s]+/', $spaceConversion, -1, PREG_SPLIT_NO_EMPTY);

            foreach($wordArraySearched as $value){
                $query->where('address', 'like', '%'.$value.'%')
                    ->orWhere('email', 'like', '%'.$value.'%')
                    ->orWhere('tel', 'like', '%'.$value.'%')
                    ->orWhere('site_name', 'like', '%'.$value.'%')
                    ->orWhere('creditCardType', 'like', '%'.$value.'%')
                    ->orWhere('creditCardNumber', 'like', '%'.$value.'%');
            }
            
            $posts = $query->paginate(5);
        }
        
        return view('posts.index',compact('user','posts','search'));
    }
    
     public function notification(User $user, InformationNotification $notifications)
    {
        $user = Auth::user();
        //dd($posts);
        // 対象のページ番号取得
        //$page =  $request->get('page', 1);
        // ページネーションで取得
        $notifications = $user ->paginatedInformations(5);
        //$user->notifications()->paginate(3);
        //dd($notifications);
        return view('posts.notification',compact('user', 'notifications'));
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
        //dd($input_information);
        $post->fill($input_post)->save();
        $input_information['post_id'] = $post->id;
        //dd($post);
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
        //dd($input_information);
        $post->fill($input_post)->save();
        $input_information['post_id'] = $post->id;
        //ifでpostとinformationが一致しなければ以下の操作は行わないようにする
        $information->fill($input_information)->save();
        
        //dd($information);
        // お知らせ内容を対象ユーザー宛てに通知登録
        $user = Auth::user();
        //dd($user);
        $user->notify(
            new InformationNotification($information)
        );
        
        return redirect('/index/' . $post->id );
        
    }
    
    public function delete(Post $post, Information $information)
    {
        //$information->where('site_name', $post->site_name )->get();
        //dd($post);
        //$information->delete();
        $post->delete();
        return redirect('/index');
    }
    
     /**
     * 通知を既読にする
     *
     * @param DatabaseNotification $notification
     * @return \Illuminate\Http\RedirectResponse
     */
    public function read(DatabaseNotification $notification)
    {
        $notification->markAsRead();

        return redirect()->back();
    }

    /**
     * 全ての通知を既読にする
     *
     * @param DatabaseNotification $notification
     * @return \Illuminate\Http\RedirectResponse
     */
    public function readAll(DatabaseNotification $notification)
    {
        auth()->user()->unreadNotifications->markAsRead();

        return redirect(route('notifications.index'));
    }
    
    public function send(User $user, string $information)
    {
        $user->notify(new InformationNotification(

            $information

            ));
    }

}



