<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <title>Home</title>
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">
    </head>
    <x-app-layout>
    <body>
        <div style="text-align:center;" class="title">
        <h1>サイト一覧</h1>
        </div>
        <br>
        <div style="text-align:center;" class="information">
        @foreach($posts as $post)
            <h2>
             <a href="/index/{{ $post->id }}">{{ $post->site_name }}</a>
             </h2>
             <br>
        @endforeach
        </div>
           {{ $posts->links() }}
        <br>
    
        <div style="text-align:center;" class="footer">
            <a href="/index/store">新規作成</a>
        </div>
        
        <div class="notifications">
        @forelse(auth()->user()->notifications()->take(5)->get() as $notification)
            <div class="{{ is_null($notification->read_at) ? 'un-read' : '' }}">
                <p>{{ $notification->data['site_name'] }}で情報が変更されました。</p>
                <a href="{{ $notification->data['site_url'] }}">●{{ $notification->data['site_url'] }}</a>
                <br>
            </div>
        @empty
            <p>まだ通知はありません</p>
        @endforelse
        {{ $notification->links() }}
        </div>
    </body>
     </x-app-layout>
</html>