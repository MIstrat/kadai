<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Pagination\Paginator;
use App\Models\User;
use App\Models\Site;

class Post extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'email',
        'address',
        'tel',
        'site_name',
        'site_url',
        'user_id'
    ];
        
    
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
    

}
