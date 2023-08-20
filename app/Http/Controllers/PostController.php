<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\Site;
use App\Models\User;
use App\Models\Information;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Http\FormRequest;
use App\Http\Requests\PostRequest;
use App\Notifications\InformationNotification;
use Illuminate\Notifications\DatabaseNotification;
use App\Services\SlackNotificationServiceInterface;

class PostController extends Controller
{
    //public function index(Post $post)
    //{
      //  return view('posts.index')->with(['posts' => $post->get()]);
    //}
    private $slack_notification_service_interface;
    
     public function __construct(
        SlackNotificationServiceInterface $slack_notification_service_interface,
    ) {
        $this->slack_notification_service_interface =  $slack_notification_service_interface;
    }
    
    
     public function index(User $user, Site $site, Post $post, Request $request)
    {
        $user = Auth::user();
        $posts = $user->posts()->get();
        // dd($posts);
        $sites = Site::whereBelongsTo($posts)->paginate(5);
        // $sites = $posts->paginatedSites(5);
        // $sites = $site->getPaginateByLimit(5);
        // $sites = $site->get();
        // dd($sites);
        $search = $request->input('search');
        $query = Site::whereBelongsTo($posts)->getQuery();
        // dd($sites);
        if($search){
            $spaceConversion = mb_convert_kana($search, 's');
            $wordArraySearched = preg_split('/[\s]+/', $spaceConversion, -1, PREG_SPLIT_NO_EMPTY);

            foreach($wordArraySearched as $value){
                $query
                    // ->where('address', 'like', '%'.$value.'%')
                    // ->orWhere('email', 'like', '%'.$value.'%')
                    // ->orWhere('tel', 'like', '%'.$value.'%')
                    ->Where('site_name', 'like', '%'.$value.'%')
                    ->orWhere('site_url', 'like', '%'.$value.'%');
                    // ->orWhere('creditCardType', 'like', '%'.$value.'%')
                    // ->orWhere('creditCardNumber', 'like', '%'.$value.'%');
            }
            
             $sites = $query->paginate(5);
        }
        // dd($sites);
        return view('posts.index',compact('user','sites','search'));
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
    
    public function info(Post $post, Site $site)
    {
        //$user = Auth::user();
        //$posts = $user->paginatedPosts();
        // $post = Post::find(2);
        $sites = $post->sites;
        // dd($sites);
        return view('posts.info',compact('post', 'sites'));
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
    
    
    public function edit(Post $post, Site $site)
    {
        $sites = $post->sites;
        // dd($sites);
        return view('posts.edit',compact('post','sites'));
    }
    
    public function update(PostRequest $request, Post $post, Site $site, Information $information)
    {
        // dd($request['sites']);
        // dd($request['post']['site_url']);//site_urlへのリクエストの渡し方はここを参考にする。保存は131行目の通り
        $input_post = $request['post'];
        $input_post['user_id'] = Auth::user()->id;
        
        $input_site_name = $request['sites']['site_name'];
        $input_site_url = $request['sites']['site_url'];
        $input_information = $request['sites'];
        dd($request);
        $post->fill($input_post)->save();
        // $site->fill($input_site)->save();
        // dd($post);
        $input_information['post_id'] = $site->id;
        //ifでpostとinformationが一致しなければ以下の操作は行わないようにする
        // $information->fill($input_information)->save();
        //dd($information);
        
        foreach($input_site_name as $site_name) {
            foreach($input_site_url as $site_url) {
            // dd($value);
            $site = new \App\Models\Site();
            // dd($site);
            $site['site_name'] = $site_name;
            $site['site_url'] = $site_url;// ここが入力された値
            // dd($site['site_url']);
            }
            $site->save();
        }
        
        // お知らせ内容を対象ユーザー宛てに通知登録
        $user = Auth::user();
        //dd($user);
        $user->notify(
            new InformationNotification($information)
        );
        //tryでdatabase,mail,slack通知 catch（失敗）でSlackに失敗したことの通知
        $this->slack_notification_service_interface->send("個人情報が変更されました\n"
        . "サイト名：" . $site->site_url
        . "サイトURL：" . $site->site_name
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



