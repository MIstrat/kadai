<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Site extends Model
{
    use HasFactory;
    
    public function posts()
    {
        return $this->hasMany('App\Models\Post');
    }
    
    public function user()
    {
        return $this->hasMany('App\Models\User');
    }
}
