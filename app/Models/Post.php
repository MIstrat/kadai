<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Pagination\Paginator;
use App\Models\User;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\SoftDeletes;

class Post extends Model
{
    use HasFactory;
    use Notifiable;
    use SoftDeletes;
    
    protected $fillable = [
        'email',
        'address',
        'tel',
        'creditCardType',
        'creditCardNumber',
        'site_name',
        'site_url',
        'user_id',
    ];
        
    
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
    
    public function user()
    {
        return $this->belongsTo('App\Models\User');
    }
    
    //public function getPaginateByLimit(int $limit_count = 1)
    //{
      //  return $this->orderBy('id')->paginate($limit_count);
    //}

    public static function getPaginateByLimit(int $userId, int $limit_count = 1) 
    {
        return self::where('user_id', $userId)->orderBy('id')->paginate($limit_count);
    }
    
    public static function boot()
    {
        parent::boot();
        
        static::deleted(function ($user)
        {
            $user->post()->delete();
        });
    }
    
    public function post()
    {
        return $this->hasMany('App\Models\Information');
    }
    

}
