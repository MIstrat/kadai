<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

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
        return $this->hasMany(User::class);
    }
    
    public function sites()
    {
        return $this->hasOne(Site::class);
    }
}
