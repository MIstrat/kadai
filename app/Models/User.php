<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use App\Models\Post;
use App\Models\Information;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
    
    public function posts()
    {
        return $this->hasMany('App\Models\Post');
    }
    
    public function paginatedPosts($limit_count= 1) 
    {
        return $this->posts()->orderBy('id')->paginate($limit_count);
    }
    
    public function information(User $user)
    {
        // ユーザーはとりあえず決めうち
        $user = User::find(1);
        
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
    
}
