<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use App\Models\Post;
use App\Models\User;

class Site extends Model
{
    use HasFactory,Notifiable;
    
    protected $fillable = [
        'site_name',
        'site_url',
        'post_id'
        ];
        
    // protected $primaryKey = 'site_name';
    
     public function post()
    {
        return $this->belongsTo('App\Models\Post');
    }
    
     public function information(User $user)
    {
        // ユーザーはとりあえず決めうち
        $user = Auth::user();
        
        //  全通知を取得
        foreach ($user->notifications as $notification) {
            echo $notification->type;
        }
        
        //  未読の通知のみを取得
        foreach ($user->unreadNotifications as $notification) 
        {
            echo $notification->type;
        }
    }
    
     public static function boot()
    {
        parent::boot();
        
        static::deleted(function ($user)
        {
            $user->site()->delete();
        });
    }
    
     public function getPaginateByLimit(int $limit_count = 5) 
    {
        return $this->orderBy('id')->paginate($limit_count);
    }
    
    public function getSites(User $user) 
    {
        $posts = $user->posts()->get();
        // $sites = Site::whereBelongsTo($posts)->paginate(5);
        return $this->whereBelongsTo($posts)->paginate(5);
        // return $this->posts()->orderBy('id')->get();
    }
}
