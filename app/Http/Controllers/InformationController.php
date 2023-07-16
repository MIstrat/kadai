<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Notifications\InformationNotification;
use App\Models\Post;
use App\Models\Information;
use App\Models\User;
use App\Http\Requests\PostRequest;
use App\Http\Controllers\PostController;

class InformationController extends Controller
{
    
    public function store(Request $request)
    {
        //dd($information);
        // お知らせテーブルへ登録
       
        $information = Information::create([
            'site_name' => $request->get('site_name'),
            'site_url' => $request->get('site_url'),

        ]);
        

        // お知らせ内容を対象ユーザー宛てに通知登録
        $user = User::find($request->get('user_id'));
        $user->notify(
            new InformationNotification($information)
        );
    }
}


