<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Site;
use App\Models\Post;

class SiteController extends Controller
{
    //
    
        public function s_edit(Site $site, Post $post)
    {
        $site -> get('sites'); 
        $post = $site->posts;
        return view('posts.siteedit',compact('post','site'));
    }
}
