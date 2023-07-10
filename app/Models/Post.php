<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Models\Site;

class Post extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'email',
        'address',
        'tel',
        ];
        
    
    public function users()
    {
        return $this->belongsTo(User::class);
    }
    
    public function sites()
    {
        return $this->belongsTo(Site::class);
    }
}
