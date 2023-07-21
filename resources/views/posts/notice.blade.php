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
        <h1>通知一覧</h1>
        </div>
        <br>
        <form action="/notice" method="POST">
            @csrf
                <div style="text-align:center;" class="notifications">
                @forelse($notifications as $notification)
                    <div class="{{ is_null($notification->read_at) ? 'un-read' : '' }}">
                        <p>{{ $notification->data['site_name'] }}で情報が変更されました。</p>
                        <input type="submit" value={{ $notification->data['site_url'] }}>
                        <br>
                        
                    </div>
                    <br>
                @empty
                    <p>まだ通知はありません</p>
                @endforelse
                {{ $notifications->links() }}
                </div>
        </form>
    </body>
     </x-app-layout>
</html>