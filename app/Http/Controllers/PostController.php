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
        // dd($posts);
        // dd($posts->isEmpty());
        if ($posts->isEmpty()){
            $sites = [];
            $search = '';
            // dd($posts);
        }else if($posts->isNotEmpty()){
            // dd($posts);
            $sites = Site::whereBelongsTo($posts)->paginate(5);
            $search = $request->input('search');
            // $query_site = Site::query();
            $query_post = Post::query();
        
            // dd($sites);
            if($search){
                $spaceConversion = mb_convert_kana($search, 's');
                $wordArraySearched = preg_split('/[\s]+/', $spaceConversion, -1, PREG_SPLIT_NO_EMPTY);
    
                foreach($wordArraySearched as $value){
                    $query_post 
                        ->where('address', 'like', '%'.$value.'%')
                        ->orWhere('email', 'like', '%'.$value.'%')
                        ->orWhere('tel', 'like', '%'.$value.'%')
                        ->orWhere('creditCardType', 'like', '%'.$value.'%')
                        ->orWhere('creditCardNumber', 'like', '%'.$value.'%');
                    // $query_site
                    //     ->Where('site_name', 'like', '%'.$value.'%')
                    //     ->orWhere('site_url', 'like', '%'.$value.'%');
                }
                $posts = $query_post->paginate(5);
                // $sites = $query_site->paginate(5);
            }
        }
        // dd($sites[0]);
        return view('posts.index',compact('user','posts','sites','search'));
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
        // $user = Auth::user();
        // $posts = $user->posts()->get();
        // $post = Post::find(2);
        $sites = $post->sites;
        //  foreach(array_keys($site) as $key) {
            // dd($key);
            // $sites['site_name'] = $site['site_name'];
            // $sites['site_url'] = $site['site_url'];
            // $sites['post_id'] = $site['post_id'];
            // dd($site);
        // }
        // dd($site['site_name']);
        return view('posts.info',compact('post', 'sites'));
    }
    
     public function add(Post $post)
    {
        //$user = Auth::user();
        //$post = posts->get();
        return view('posts.store')->with(['post' => $post]);
    }
    
    public function store(Site $site, PostRequest $request, Post $post, Information $information)
    {
        $input_post = $request['post'];
        $input_post['user_id'] = Auth::user()->id;
        $post->fill($input_post)->save();
        
        $input_site = $request['site'];
        $input_site['post_id'] = $post->id;
        $site->fill($input_site)->save();
        // $sites = Site::whereBelongsTo($post)->first();
        // $input_site['post_id'] = $sites['post_id'];
        
        $input_information = $request['site'];
        $input_information['site_id'] = $site->id;
        $information->fill($input_information)->save();
        // dd($information);
        
        return redirect('/index' );
    }
    
    
    public function edit(Post $post, Site $site)
    {
        $sites = $post->sites()->get();
        // $sites = $sites[0];
        // dd($sites);
        return view('posts.edit',compact('post','sites'));
    }
    
    public function update(PostRequest $request, Post $post, Site $site, Information $information)
    {
        $input_post = $request['post'];
        // $input_post['user_id'] = Auth::user()->id;
        $post->fill($input_post)->save();
        // dd($request);
        
        $input_sites = $request['sites'];
        // dd($input_sites);
        foreach($input_sites as $id => $data) {
            // dd($data);
            // $sites = $input_sites[$key];
            Site::where('id',$id)->update([
                'site_name' => $data['site_name'],
                'site_url' => $data['site_url'],
                'post_id' => $data['post_id'],
            ]);
        }
        // dd($request);
        
        foreach($request['newSites'] as $id => $key){
            $input_newSites = $key;
            // dd($input_newSites);
            if ($input_newSites['site_name'] && $input_newSites['site_url']== null){
            }elseif (!null == ($input_newSites['site_name'] && $input_newSites['site_url'])){
                $site = new \App\Models\Site();
                $sites = $input_newSites;
                $sites['post_id'] = $post->id;
                // dd($sites);
                $site->fill($sites)->save();
                // dd($site);
                $informations = $input_newSites;
                $informations['site_id'] = $site->id;
                $information->fill($informations)->save();
            
                // お知らせ内容を対象ユーザー宛てに通知登録
                $user = Auth::user();
                $user->notify(
                    new InformationNotification($information)
                );
                //tryでdatabase,mail,slack通知 catch（失敗）でSlackに失敗したことの通知
                $this->slack_notification_service_interface->send("個人情報が変更されました\n"
                    . "サイト名：" . $site->site_url
                    . "サイトURL：" . $site->site_name
                );
            }
        }
        
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



